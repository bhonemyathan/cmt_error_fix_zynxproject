@extends('layout.master')
@section('content')
        <!-- Post -->
        @foreach ($articles as $a)
<div class="post-container p-4 rounded shadow mt-3">
              <!-- author -->
              <div class="d-flex justify-content-between">
                <!-- avatar -->
                <div class="d-flex">
                  <img src="{{$a->user->image}}" alt="avatar" class="rounded-circle me-2" style="width: 38px; height: 38px; object-fit: cover">
                  <div>
                    <p class="m-0 fw-bold"></p>
                    <p class="m-0 fw-bold">{{$a->user->name}}</p>
                    <span class="text-muted fs-7">{{$a->created_at}}</span>
                  </div>
                </div>
              </div>
              <!-- post content -->
              <div class="mt-3">
                <!-- content -->
                <div>
                  <p>
                    {{$a->description}}
                  </p>
                  <img src="{{$a->image}}" alt="post image" class="img-fluid rounded">
                </div>
                <!-- likes & comments -->
                <div class="post__comment mt-3 position-relative">
                  <!-- likes -->
                  <div class="
                      d-flex
                      align-items-center
                      top-0
                      start-0
                      position-absolute
                    " style="height: 50px; z-index: 5">
                    <div class="me-2">
                        <i class="text-primary fas fa-heart" style="padding-bottom: 25px;">
                        </i>
                      </div>
                    <p class="m-0 text-muted fs-7" style="padding-bottom: 25px;"
                    id="like_count{{$a->id}}" >
                        {{$a->like_count}}
                    </p>
                  </div>
                  <!-- comments start-->
                  <div class="post-row" id="accordionExample">
                    <div class="item border-0">
                      <!-- comment collapse -->
                      <h2 class="" id="">
                        <div class=" pointer d-flex justify-content-end collapsed">
                            <p class="m-0" style="font-size:15px;" >{{$a->comment_count}} Comments</p>
                        </div>
                      </h2>
                      <hr>
                      {{-- <a href="{{url('article/'.$a->slug)}}"
                        class="badge badge-warning p-1">View</a> --}}
                      <!-- comment & like bar -->
                      <div class="d-flex justify-content-around" >
                        <div class="
                            dropdown-item
                            rounded
                            d-flex
                            justify-content-center
                            align-items-center
                            pointer
                            text-muted
                            p-1
                          ">
                          <i
                          id="like{{$a->id}}"
                                onclick="like({{$a->id}})"
                                user_id="@if(Auth::check()){{Auth::user()->id}}@endif"
                                class="fas fa-heart me-3"
                                article_id="{{$a->id}}">
                            </i>

                          <p class="m-0">Like</p>
                        </div>
                        <div class="dropdown-item rounded d-flex
                        justify-content-center align-items-center pointer text-muted p-1 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#collapsePost{{$a->id}}"
                        aria-expanded="false" aria-controls="collapsePost{{$a->id}}"

                        id="comment{{$a->id}}"
                        onclick="comment({{$a->id}})"
                        user_id="@if(Auth::check()){{Auth::user()->id}}@endif"
                        class="fas fa-heart me-3"
                        article_id="{{$a->id}}">
                          <i class="fas fa-comment-alt me-3"></i>
                          <p class="m-0">Comment</p>
                        </div>
                      </div>
                      <!-- comment expand -->

                      <div id="collapsePost{{$a->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                        <hr>
                        <div class="accordion-body">

                          <!-- loop comment -->
                          @foreach ($a->comment as $c)
                          <div id="comment_list" >
                            <div class="d-flex align-items-center my-1">
                                <!-- avatar -->
                                <img src="{{asset($c->user->image)}}" alt="avatar" class="rounded-circle me-2" style="
                                    width: 38px;
                                    height: 38px;
                                    object-fit: cover;
                                  ">
                                <!-- comment text -->
                                <div class="p-3 rounded comment__input w-100">
                                  <!-- comment menu of author -->
                                  <div class="d-flex justify-content-end">
                                    <!-- icon -->
                                    <i class="fas fa-ellipsis-h text-blue pointer" id="post1CommentMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <!-- menu -->
                                    <ul class="dropdown-menu border-0 shadow" aria-labelledby="post1CommentMenuButton">
                                      <li class="d-flex align-items-center">
                                        <a class="
                                            dropdown-item
                                            d-flex
                                            justify-content-around
                                            align-items-center
                                            fs-7
                                          " href="#">
                                          Edit Comment</a>
                                      </li>
                                      <li class="d-flex align-items-center">
                                        <a class="
                                            dropdown-item
                                            d-flex
                                            justify-content-around
                                            align-items-center
                                            fs-7
                                          " href="#">
                                          Delete Comment</a>
                                      </li>
                                    </ul>
                                  </div>
                                  <p class="fw-bold m-0">{{$c->user->name}}</p>
                                  <p class="m-0 fs-7 bg-gray p-2 rounded">
                                    {{$c->comment}}
                                  </p>
                                </div>
                              </div>
                          </div>
                          @endforeach
                          

                          <!-- create comment -->
                          <form class="d-flex my-1">
                            <!-- avatar -->
                            <div>
                              <img src="@if (Auth::check())
                                  {{Auth::user()->image}}
                              @endif" alt="avatar" class="rounded-circle me-2" style="
                                  width: 38px;
                                  height: 38px;
                                  object-fit: cover;
                                ">
                            </div>
                            <!-- input -->
                            <input type="text"
                            class="form-control border-0 rounded-pill bg-gray"
                            placeholder="Write a comment" id="comment" >
                            <input type="button" value=">" class="btn btn-primary"
                            id="create_comment"  >
                          </form>
                          <!-- end -->
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- end -->
                </div>
                
              </div>
              
            </div>
            
        @endforeach
            <a href="{{$articles->previousPageUrl()}}" class="btn btn-outline-warning text-warning float-left ">
                Prev Posts
            </a>
            <a href="{{$articles->nextPageUrl()}}" class="btn btn-outline-success" style="float:right;" >
                Load More
            </a>
    </div>

                <!----------------Right Sidebar----------------------->
                <div class="right-sidebar">
                    <img src="{{asset('/image/logo.png')}}" class="siderbar-ads">
                        <div class="imp-links">
                            <a href="#" style="text-decoration: none;" ><img src="https://i.postimg.cc/44FRWj1b/group.png">Suggest For You</a>
                            @foreach ($users as $u)
                            <div class="online-list">
                                <div class="online">
                                    <img src="{{$u->image}}">
                                </div>
                                <p>{{$u->name}}</p>
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
            <div class="footer">
                <p>Copyright 2022 - Vkive Tutorials</p>
            </div>
@endsection


@section('script')
<script>

  //like

    function like(id){

        var like = document.getElementById(`like${id}`);
        var like_count = document.getElementById(`like_count${id}`);

        var user_id = like.getAttribute('user_id');
        var article_id = like.getAttribute('article_id');

            //laravel
            axios.get('/article/like/'+user_id+article_id)

            .then(function(res){
                if(res.data.unlike == 'already exist'){
                    like_count.innerHTML = res.data.data;
                    toastr.success('unlike success');
                }
                if(Number.isInteger(res.data)){
                    like_count.innerHTML = res.data;
                }
        })
    }

    //comment

    function comment(id){

        const comment = document.getElementById('comment');
        const comment_list = document.getElementById('comment_list');
        const create_comment = document.getElementById('create_comment');

        var article_id = comment.getAttribute('article_id');
        create_comment.addEventListener('click',()=>{
            const formData = new FormData();
            formData.append('comment',comment.value);
            formData.append('article_id',id);
            axios.post('/comment/create/',formData)
            .then(function(res){
                toastr.success('Created comment');
                comment_list.innerHTML = res.data.data;
            })
        });


    }
</script>

@endsection
