@extends($param['crudview'].'.show')
@section('datas')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Workertime{{ $data->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/manager/workerdays') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                  

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Műszak</th><td>{{ $data->wroleunits->name  }}</td>
                                    </tr>
                                    <tr>
                                        <th> Időtipus </th><td> {{ $data->imetype->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Start</th><td> {{ $item->start }} </td>
                                    </tr>
                                    <tr>
                                        <th> End</th><td> {{ $item->end }} </td>
                                    </tr>
                                    <tr>
                                        <th> Óra<</th><td> {{ $item->hour}} </td>
                                    </tr>                               
                                    <tr>
                                        <th> Szorzó<</th><td> {{ $item->timetype->szorzo }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fixplusz<</th><td> {{ $item->timetype->fixplusz }} </td>
                                    </tr>
                                    <tr>
                                        <th> Fixplusz<</th><td> {{ $workerday->datum }} </td>
                                    </tr>
                                     <tr>
                                        <th> Jegyzet</th><td> {{ $workerday->managernote}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> 
    
@endsection
