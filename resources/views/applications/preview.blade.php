@extends('base')
@section('title', 'Application Preview')

@section('css')
        <!-- Font Icon -->
<link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
<!-- Main css -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

@endsection


@section('main')

    <div class="main">
        <div class="container preview-container">
            <div class="row">

                <div class="col-md-12 top-heading">
                    <h2>Please check if there needs to correct any information</h2>
                </div>

                <div class="col-md-12">
                    <table class="table table-borderless preview-table">
                        <tbody>
                            <tr>
                                <th>Type of Institution:</th>
                                <td>School</td>
                            </tr>
                            <tr>
                                <th>Name of the Institution (In Bangla)</th>
                                <td>Rifles Public School & College</td>
                            </tr>
                            <tr>
                                <th>Name of the Institution (In English)</th>
                                <td>Rifles Public School & College</td>
                            </tr>
                            <tr>
                                <th>EIIN:</th>
                                <td>Rifles Public School & College</td>
                            </tr>
                            <tr>
                                <th>Email Address:</th>
                                <td>rpc@gmail.com</td>
                            </tr>
                            <tr>
                                <th>Telephone Number:</th>
                                <td>01717034872</td>
                            </tr>
                            <tr>
                                <th>Division</th>
                                <td>Chottogram</td>
                            </tr>
                            <tr>
                                <th>District:</th>
                                <td>Feni</td>
                            </tr>
                            <tr>
                                <th>Upazila:</th>
                                <td>Daganbhuiyan</td>
                            </tr>
                            <tr>
                                <th>Total Male Students:</th>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th>Total Female Students:</th>
                                <td>220</td>
                            </tr>
                            <tr>
                                <th>Total Teachers:</th>
                                <td>22</td>
                            </tr>
                            <tr>
                                <th>MPO?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>MPO Code:</th>
                                <td>262777</td>
                            </tr>
                            <tr>
                                <th>Nijossho fund a Computer Lab ache ki na?:</th>
                                <td>No</td>
                            </tr>
                            <tr>
                                <th>Nijosso fund a kroykrito Computer er sonkha:</th>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th>Govt or non-govt Lab?:</th>
                                <td>No</td>
                            </tr>
                            <tr>
                                <th>Prapto Lab somuho:</th>
                                <td>0</td>
                            </tr>
                            <tr>
                                <th>Active Number of Compute:</th>
                                <td>30</td>
                            </tr>
                            <tr>
                                <th>Is there any Internet Connectivity?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Type of Internet Connection:</th>
                                <td>Broadband</td>
                            </tr>
                            <tr>
                                <th>Is there any ICT Teacher?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Room available of 22 feet X 18 feet?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Building Paka na Adhapaka?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Boundary available?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Electricity or Solar System available?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>CC Camera available?:</th>
                                <td>No</td>
                            </tr>
                            <tr>
                                <th>Security Guard available?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Night Guard available?:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Institution Other Details:</th>
                                <td>jjhjshfjjs jdjsdj jhdhufr  jhvv mihjv vidmdmjd diddid m sn d jdijidkdnm mnvbvhdbkrifr  bduhjnjnjd bvv vhnknk kdivnkdfiuuhij</td>
                            </tr>
                            <tr>
                                <th>Reference?:</th>
                                <td>No</td>
                            </tr>
                            <tr>
                                <th>Reference Porichoy:</th>
                                <td>bhvgfgojiu</td>
                            </tr>
                            <tr>
                                <th>Reference Name:</th>
                                <td>ghhhjj</td>
                            </tr>
                            <tr>
                                <th>Designation:</th>
                                <td>aaaaa</td>
                            </tr>
                            <tr>
                                <th>Workstation:</th>
                                <td>bvfddd</td>
                            </tr>
                            <tr>
                                <th>Reference Document:</th>
                                <td>uuyyhklkplp</td>
                            </tr>
                            <tr>
                                <th>Postal or Direct Application:</th>
                                <td>aaaaa</td>
                            </tr>
                            <tr>
                                <th>Previous Application Date:</th>
                                <td>11.01.2019</td>
                            </tr>
                            <tr>
                                <th>Previous Application Attached:</th>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <th>Signature:</th>
                                <td>signed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section("js")
            <!-- JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    @include('applications.applicationjs')
@endsection
