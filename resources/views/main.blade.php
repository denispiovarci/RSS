@extends('layouts.app')

@section('content')
    <section class="main-container h-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md justify-content-center d-flex">
                    <form class="start-form w-75" action="{{ action('RssController@load') }}" method="get">
                        @csrf
                        <div class="mb-2">
                            <label for="url" class="text-center d-block"><b>URL soruce for RSS feed</b></label>
                            <div class="input-group flex-column">
                                <div class="d-flex justify-content-center input-group-custom">
                                    <input id="url" type="text" class="form-input custom-input"
                                           placeholder="https://dennikn.sk/slovensko/feed/"
                                           aria-label="Recipient's username"
                                           name="url">
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <label for="orderBy"> <b>Order by:</b></label>
                                </div>
                                <div class="d-flex justify-content-center input-group-custom">
                                    <select class="form-input custom-input"
                                            id="orderBy" name="orderBy">
                                        <option value="1">PubDate - From Newest</option>
                                        <option value="2">PubDate - From Latest</option>

                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" name="submit">Submit
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <label><b>Articles:</b></label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-0">

                            @php
                                $counter=0;
                            @endphp

                            @if($orderBy == 1)
                                @foreach($data['items'] as $item)

                                    <div class="d-flex justify-content-left list">
                                        <p>
                                            <a href="{{ $item->get_permalink() }}"> {{ $item->get_date('j M Y | g:i a') }}
                                                -- {{ $item->get_title() }}</a></p>
                                    </div>

                                @endforeach
                            @endif

                            @if($orderBy == 2)

                                @foreach($data['items'] as $item)
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach

                                @for($i = $counter-1; $i >= 0; $i--)
                                    <div class="d-flex justify-content-left list">
                                        <p>
                                            <a href="{{ $data['items'][$i]->get_permalink() }}"> {{ $data['items'][$i]->get_date('j M Y | g:i a') }}
                                                -- {{ $data['items'][$i]->get_title() }}</a></p>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </form>
                </div>

                @if($orderBy == 1)

                    <div class=" col-md justify-content-right">
                        @foreach($data['items'] as $item)
                            @php

                                $enclosure = $item->get_enclosure();
                                $image_url = $enclosure->get_link();
                                $imageData = base64_encode(file_get_contents($image_url));

                            @endphp
                            <div class="p-3 mb-2 article-item">
                                <h2 style="color:black"><b> {{ $item->get_title() }}</b></h2>
                                <img alt="1" src="data:image/jpeg;base64,{{ $imageData }}" class="w-100"/>
                                <div class="mt-3">
                                    <p><b>Publication date:</b> {{ $item->get_date('j M Y | g:i a') }}</p>
                                </div>
                                <p><b>Description:</b> {{ $item->get_description() }}</p>
                                <p>
                                    <a href="{{ $item->get_permalink() }}"> <b>Full article</b></a></p>
                            </div>

                        @endforeach
                    </div>
                @endif

                @if($orderBy == 2)

                    @php
                        $counter=0;
                    @endphp

                    @foreach($data['items'] as $item)
                        @php
                            $counter++;
                        @endphp
                    @endforeach

                    <div class=" col-md justify-content-right">
                        @for($i = $counter-1; $i >= 0; $i--)

                            @php
                                $enclosure = $data['items'][$i]->get_enclosure();
                                $image_url = $enclosure->get_link();
                                $imageData = base64_encode(file_get_contents($image_url));
                            @endphp

                            <div class="p-3 mb-2 article-item">
                                <h2 style="color:black"><b> {{ $data['items'][$i]->get_title() }}</b></h2>
                                <img alt="1" src="data:image/jpeg;base64,{{ $imageData }}" class="w-100"/>
                                <div class="mt-3">
                                    <p><b>Publication date:</b> {{ $data['items'][$i]->get_date('j M Y | g:i a') }}</p>
                                </div>
                                <p><b>Description:</b> {{ $data['items'][$i]->get_description() }}</p>
                                <p>
                                    <a href="{{ $data['items'][$i]->get_permalink() }}"> <b>Full article</b></a></p>
                            </div>
                        @endfor
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
