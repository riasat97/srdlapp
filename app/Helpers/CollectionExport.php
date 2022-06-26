<?php


namespace App\Helpers;


use GuzzleHttp\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectionExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $url = 'https://fantasy.premierleague.com/';
        $client = new Client(['base_uri' => $url]);

        $jdb = $client->request('GET', '/api/bootstrap-static/');
        $chuna = $client->request('GET', '/api/entry/1282452/event/3/picks/');
        //dd($response);
        //$response = $client->request('GET', '/api/users', ['query' => ['page' => '1', "per_page" => 1]]);

        $jdb = $jdb->getBody();
        $chuna = $chuna->getBody();
        $jdbArr= json_decode($jdb, true)['elements'];
        $chunaArr= json_decode($chuna, true)['picks'];
        //echo '<pre>';
        //print_r($chuna);
        //dd($jdbArr);
        //$players=[];
        foreach ($chunaArr as $chuna){
            $playerId=$chuna['element'];
            foreach ($jdbArr as $jdb){
                if($jdb['id']==$playerId){
                    $players[]=['position'=>$chuna['position'],'web_name'=>$jdb['web_name'],
                        'pts'=>$jdb['event_points'],'captain'=>$chuna['is_captain'],'vice_captain'=>$chuna['is_vice_captain']];
                }
            }
        }
        $col = array_column( $players, "position" );
        array_multisort( $col, SORT_ASC, $players );
        return collect($players);
    }

    public function headings(): array
    {
        return [
            'Position',
            'Name',
            'Pts',
            'Captain',
            'Vice-captain'
        ];
    }

}
