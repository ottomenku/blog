@extends('libro.base') 
@section('content')

            <div class="page-container float-right">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-3" <h2>{{ $data['cim'] }}</h2>
                  
                            <img src="{{ $data['images'] }}" alt="" class="img-fluid">
                    <p>  </p>
                        <div class="tag-widget post-tag-container mb-5 mt-5">
                            <div class="tagcloud">
                                <a href="#" class="tag-cloud-link">Life</a>
                                <a href="#" class="tag-cloud-link">Sport</a>
                                <a href="#" class="tag-cloud-link">Tech</a>
                                <a href="#" class="tag-cloud-link">Travel</a>
                            </div>
                        </div>

                        <div class="about-author d-flex pt-5">
                            <div class="bio align-self-md-center mr-4">
                                <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
                            </div>
                            <div class="desc align-self-md-center">
                                <h3>About The Author</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate
                                    numquam!
                                </p>
                            </div>
                        </div>


                    </div>
                    <!-- .col-md-12 -->
                </div>
            </div>
            <!-- end: page-container-->
 @endsection('content')     