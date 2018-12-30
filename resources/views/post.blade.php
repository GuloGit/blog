@extends("layouts.public")
@section("content")
    <div class="content">
        <div class="content__posts--single">
            <div class="post post--single ">
                 <div class="post__image--single">
                     <img class="post__img" src="{{Storage::url($post->image)}}"/>
                 </div>
                 <div class="post__content">
                          <div class="post__title post__title--single">{{$post->title}}</div>
                     <div class="post__feedback">
                        <div class="post__rating" data-id="{{$post->title}}">
                            <span  class="post__dislike">0</span> <button id="dislike" class="btn btn__rating btn__rating--left"></button>
                            <span  class="post__like">0</span><button id="like" class="btn btn__rating btn__rating--right"></button>
                        </div>

                            <div class="post__share">

                                 <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                                 <script src="//yastatic.net/share2/share.js"></script>
                                 <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir" data-counter="">
                                 </div>
                            </div>
                     </div>
                            <span class="post__category">{{$post->category->name}}</span>
                            <span class="post__date">{{$post->updated_at}}</span>
                            <div class="post__text">{{$post->text}}</div>
                 </div>
                    <div class="post__discus">
                        <div id="disqus_thread"></div>
                        <script>

                            /**
                             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                            /*
                            var disqus_config = function () {
                            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };
                            */
                            (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://blog-y2zney0pyg.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                   </div>

            </div>
        </div>
    </div>
@endsection