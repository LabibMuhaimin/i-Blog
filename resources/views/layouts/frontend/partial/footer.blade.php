<footer>

		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						
						<h4 class="title"><b>About Us</b></h4>
						<h5>iBlog is a blogging platform where passionate authors can write about the things that they love and post...<a href="{{ route('about')}}">See More</a></h5>
						<br>
						<ul class="icons">
							<li><a href="https://www.facebook.com"><i class="ion-social-facebook"></i></a></li>
							<li><a href="https://www.twitter.com"><i class="ion-social-twitter"></i></a></li>
							<li><a href="https://www.instagram.com"><i class="ion-social-instagram-outline"></i></a></li>
						</ul>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
						<div class="footer-section">
						<h4 class="title"><b>CATAGORIES</b></h4>
						<ul>
							@foreach($categories as $category)
								
								<li><button  type="button" class="btn btn-primary" ><a href="{{route('category.posts', $category->slug)}}">{{$category->name}}</a>
								<span class="badge badge-warning">{{$category->posts->count()}}</span>
								
  										</button>
								</li>
							@endforeach
						</ul><br>
						<h4 class="title"><b>TAGS</b></h4>
						<ul>
							@foreach($tags as $tag)
								<li><a href="{{route('tag.posts', $tag->slug)}}">{{$tag->name}}</a></li>
							@endforeach
						</ul>
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4><!--<a href="{{ route('subscriber_page')}}">See More</a>-->
						<div class="input-area">
							<form method="POST" action ="{{ route('subscriber.store')}}" >
							@csrf
								<input class="email-input" name ="email" type="email" placeholder="Enter your email" style="height:50px;">
								<button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

			</div><!-- row -->
		</div><!-- container -->
	</footer>