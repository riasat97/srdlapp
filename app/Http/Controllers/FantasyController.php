<?php

namespace App\Http\Controllers;

use App\Classes\FplApi;
use App\Helpers\CollectionExport;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class FantasyController extends Controller
{
    public $url = 'https://fantasy.premierleague.com/';

    public function getClient(){
        return $client = new Client(['base_uri' => $this->url]);

    }

    public function fantasyDB(){
        $client = $this->getClient();
        $element = $client->request('GET', '/api/bootstrap-static/');
        $element = $element->getBody();
        return $element;
    }
    function array2dTo1d($array2d)
    {
        return array_reduce($array2d, function($carry, $array) {
            return array_merge($carry, $array);
        }, []);
    }

    private function getCaptainPoint($is_captain,$chunaChip,$count)
    {
        if($chunaChip=="3xc" && $is_captain) return 3*$count;
        if($is_captain) return  2*$count;
        else return $count;
    }
    public function getEntries($entrys,$event,$elements){

        foreach ($entrys as $entry){
            $chuna = $this->getClient()->request('GET', '/api/entry/'.$entry.'/event/'.$event.'/picks/');
            //$response = $client->request('GET', '/api/users', ['query' => ['page' => '1', "per_page" => 1]]);
            $chuna = $chuna->getBody();
            $chunaArr= json_decode($chuna, true)['picks'];
            $chunaChip= json_decode($chuna, true)['active_chip']?json_decode($chuna, true)['active_chip']:0;
            //echo '<pre>';
            //print_r($chuna);
            //dd($chunaArr);
            //$players=[];
            $b=0;
            foreach ($chunaArr as $chuna){

                $playerId=$chuna['element'];
                $historys = $this->getClient()->request('GET', '/api/element-summary/'.$playerId.'/');
                $historys = $historys->getBody();
                $historys= json_decode($historys, true)['history'];

                $pts=[];
                foreach ($historys as $history){
                    if($history['round']==$event){
                        $pts[$playerId]= $history['total_points'];
                    }
                }
                $c=0;
                foreach ($elements as $element){
                    if($element['id']==$playerId){
                        $c++;
                        $entries[$entry][]=['entry'=>$entry,'id'=>$chuna['element'],'position'=>$chuna['position'],'web_name'=>$element['web_name'],
                            'pts'=>$chuna['is_captain']?2*$pts[$playerId]:$pts[$playerId],
                            'c'=>$this->getCaptainPoint($chuna['is_captain'],$chunaChip,$c),
                            'captain'=>$chuna['is_captain'],'vice_captain'=>$chuna['is_vice_captain'],
                            'active_chip'=>$chunaChip];
                    }
                }

                if($b==10)
                {break;}
                $b++;

            }

            //$col = array_column( $players, "position" );
            //array_multisort( $col, SORT_ASC, $players );
        }
        return $entries;
    }
    public function getEachTeamUniquePlayer($tMerged){
        $group = array();
        foreach ( $tMerged as $value ) {
            $group[$value['id']][] = $value;
        }
        array_multisort($group,SORT_DESC);
        //dd($group);
        foreach ($group as $eepgrp){
            $pts=0;$c=0;
            foreach ($eepgrp as $player){
                $pts+= $player['pts'];
                $c+= $player['c'];
                $pID= $player['id'];
                $pName= $player['web_name'];
            }
            $unique[$pID]=['id'=>$pID,'name'=>$pName,'c'=>$c,'pts'=>$pts];
        }
        return $unique;
    }

    public function index(Request $request)
    {
        $entrys=explode(',',$request->get('entry'));
        $event=$request->get('event');
        $elementArr= json_decode($this->fantasyDB(), true)['elements'];

        return view('fantasy',['entrys'=>$this->getEntries($entrys,$event,$elementArr)]);

    }

    public function teams($event, Request $request){

        $t1=explode(',',$request->get('t1'));
        $t2=explode(',',$request->get('t2'));
        $elementArr= json_decode($this->fantasyDB(), true)['elements'];
        $t1Entries= $this->getEntries($t1,$event,$elementArr);
        $t1Merged=$this->array2dTo1d($t1Entries);
        $t2Entries= $this->getEntries($t2,$event,$elementArr);
        $t2Merged=$this->array2dTo1d($t2Entries);

        $t1u=$this->getEachTeamUniquePlayer($t1Merged);
        $t2u=$this->getEachTeamUniquePlayer($t2Merged);
        $common=array_intersect_key($t1u,$t2u);
        $finalPlayers=[];

        foreach ($common as $comn) {
            $id= $comn['id'];
            if($t1u[$id]['pts']>$t2u[$id]['pts']){
               $wonBy= $t1u[$id]['pts']- $t2u[$id]['pts'];
               $winner= 'T1';
            }
            elseif($t1u[$id]['pts']<$t2u[$id]['pts']){
                $wonBy= $t2u[$id]['pts']- $t1u[$id]['pts'];
                $winner= 'T2';
            }
            elseif($t1u[$id]['pts']==$t2u[$id]['pts']){
                $wonBy= $t2u[$id]['pts']- $t1u[$id]['pts'];
                $winner= 'DRAW';
            }
            else{
                $wonBy='undefined';
                $winner='undefined';
            }
            $t1cwonBy=0;
            $t2cwonBy=0;

            if($t1u[$id]['c']>$t2u[$id]['c']){
                $t1cwonBy= $t1u[$id]['c']- $t2u[$id]['c'];
            }
            elseif($t1u[$id]['c']<$t2u[$id]['c']){
                $t2cwonBy= $t2u[$id]['c']- $t1u[$id]['c'];
            }
            elseif($t1u[$id]['c']==$t2u[$id]['c']){
                $t1cwonBy= $t1u[$id]['c']- $t2u[$id]['c'];
                $t2cwonBy= $t2u[$id]['c']- $t1u[$id]['c'];
            }
            else{
                $t1cwonBy='undefined';
                $t2cwonBy='undefined';
            }
            $finalPlayers[$id]=['name'=>$comn['name'],'t1c'=>$t1u[$id]['c'],'t2c'=>$t2u[$id]['c'],
                't1p'=>$t1u[$id]['pts'],'t2p'=>$t2u[$id]['pts'],'winner'=>$winner,'wonBy'=>$wonBy,'t1cwonBy'=>$t1cwonBy,'t2cwonBy'=>$t2cwonBy];

        }

        $t1Diff=array_diff(array_keys($t1u),array_keys($t2u));
        $t1Diff=array_values($t1Diff);
        if(count($t1Diff)){
        foreach ($t1Diff as $id){
            $finalPlayers[$id]=['name'=>$t1u[$id]['name'],'t1c'=>$t1u[$id]['c'],'t2c'=>0,
                't1p'=>$t1u[$id]['pts'],'t2p'=>0,'winner'=>$t1u[$id]['pts']?'T1':'DRAW','wonBy'=>$t1u[$id]['pts'],
                't1cwonBy'=>$t1u[$id]['c'],'t2cwonBy'=>0];
        }
        }

        $t2Diff=array_diff(array_keys($t2u),array_keys($t1u));
        $t2Diff=array_values($t2Diff);
        if(count($t2Diff)){
            foreach ($t2Diff as $id){
                $finalPlayers[$id]=['name'=>$t2u[$id]['name'],'t1c'=>0,'t2c'=>$t2u[$id]['c'],
                    't1p'=>0,'t2p'=>$t2u[$id]['pts'],'winner'=>$t2u[$id]['pts']?'T2':"DRAW",'wonBy'=>$t2u[$id]['pts'],
                    't2cwonBy'=>$t2u[$id]['c'],'t1cwonBy'=>0];
            }
        }

        $t1pt=0;
        $t2pt=0;
        foreach ($finalPlayers as $finalPlayer){
            $t1pt+=$finalPlayer['t1p'];
            $t2pt+=$finalPlayer['t2p'];
        }

        //dd($finalPlayers);
        return view('fantasy-teams',['finalPlayers'=>$finalPlayers,'t1pt'=>$t1pt,'t2pt'=>$t2pt]);

    }
    public function login(){
        // id of the league to show
        $league_id  = "7909565";
        $fpl = new FplApi();
        $client = $fpl->getClient();
        $auth = $fpl->getAuthClient();


////////////////////log in api
        $auth->login([
            'password'=>'Riasat97!',
            'login'=>'riasatraihan@gmail.com',
            'redirect_uri'=>'https://fantasy.premierleague.com/',
            'app'=>'plfpl-web'
        ]);
        dd($auth);

    }
}
