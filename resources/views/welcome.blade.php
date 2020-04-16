@extends('layouts.app')

@section('content')

    <section class="main-container h-100">
        <div class="container-fluid">
            <div class="row">


                <div class=" col-md justify-content-center d-flex">
                    <form class="start-form w-75" action="{{ action('RssController@load') }}" method="get">
                        @csrf
                        <div class="mb-2">
                            <label for="url" class="text-center d-block"><b>URL soruce for RSS feed</b></label>
                            <div class="input-group flex-column">
                                <div class="d-flex justify-content-center input-group-custom">
                                    <input id="url" type="text" class="form-input custom-input"
                                           placeholder="https://www.sme.sk/rss-title"
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
