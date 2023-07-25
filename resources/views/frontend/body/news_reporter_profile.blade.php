@extends('frontend.profile.index')
@section("content")
    <div class="p-2 container-fluid">
        <h3 class="my-3">Reporter Profile</h3>
        <div class="mt-5 row">
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="text-center card-title">
                        <h5 class="mt-3">{{ $newsreporter->name }}</h5>
                        <div>{{ $newsreporter->email }}</div>
                        <div>{{ $newsreporter->phone }}</div>
                    </div>

                    <div class="card-body">

                        <div class="flex items-center justify-center">
                            <img src="{{ (!empty($newsreporter->photo)) ? url('backend/assets/dist/img/admin_profile/'.$newsreporter->photo):url('backend/assets/dist/img/admin_profile/no_image.jpg') }}" class="p-3 rounded-2 w-100" onclick="showFullSize()" id="showImage" alt="">
                        </div>

                        <div class="image-overlay">
                            <span class="close-btn" onclick="closeFullSize()">&times;</span>
                            <img src="{{ (!empty($newsreporter->photo)) ? url('backend/assets/dist/img/admin_profile/'.$newsreporter->photo):url('backend/assets/dist/img/admin_profile/no_image.jpg') }}" alt="Image" class="clickable-img " style="width: 80%;height:80%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 order-md-first">
                <div class="row">
                    @foreach ($news as $newsList )
                        <div class="my-3 col-12 col-md-4">
                            {{-- @if ($newsList->news_details > 0) --}}
                                <a href="#" class=" text-decoration-none text-secondary">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ asset($newsList->image) }}" alt="">
                                        <div class="card-body">
                                            <p class="card-text">{!! Str::limit($newsList->news_details, 50) !!}</p>
                                            <p>15.8.2023</p>
                                            <a href="{{ url('newspost/details/'.$newsList->id."/".$newsList->news_title_slug) }}" class="text-decoration-none text-primary">ReadMore</a>
                                        </div>
                                    </div>
                                </a>
                            {{-- @else
                                <h1>There is no relative post.</h1>
                            @endif --}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection