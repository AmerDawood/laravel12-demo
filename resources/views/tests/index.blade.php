
@extends('dashboard.master')



@section('content')
<div class="page-body">
<div class="container-xl">
<div class="col-md-12">
                <div class="row row-cards">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">All Tests</h3>
                      </div>
                     @forelse ($tests as $test)
                       <div class="list-group list-group-flush list-group-hoverable">
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-auto"><span class="badge bg-red"></span></div>
                            <div class="col-auto">
                              <a href="#">
                                <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)"></span>
                              </a>
                            </div>
                            <div class="col text-truncate">
                              <a href="#" class="text-reset d-block">{{ $test->title }}</a>

                              <div class="d-block text-secondary text-truncate mt-n1">Change deprecated html tags to text decoration classes (#29604)</div>
                            </div>

                               <a style="margin: 10px;" href="{{ route('student.tests.start', $test->id) }}" class="btn btn-primary">
                🚀 Start Test
            </a>
                            <div class="col-auto">
                              <a href="#" class="list-group-item-actions"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-secondary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
                              </a>
                            </div>
                          </div>
                        </div>


                    </div>

                     @empty

                     <h4>No Tests Found</h4>

                     @endforelse
                  </div>

                </div>
              </div>
              </div>
              </div>

@endsection
