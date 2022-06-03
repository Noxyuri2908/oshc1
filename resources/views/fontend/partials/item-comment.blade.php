@foreach($comments as $comment)
	<div class="list-commnet parent-comment">
		<div class="headr">
			<div class="avt">
				<img src="{{asset('source/p1.jpg')}}">
			</div>									
		</div>
		<div class="content-cm">
			<div class="content-head">
				<div class="title">
					<h3>{{$comment->name}}</h3>
					<div class="date">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						@php 
							$time = covert_string_date($comment);
						@endphp
						{{$time['month']}} {{$time['day']}}, {{$time['year']}}
					</div>
				</div>
				<div class="reply" style="cursor: pointer;" data-id="{{$comment->id}}" data-name="{{$comment->name}}">
					<i class="fa fa-reply" aria-hidden="true"></i>
					<span>Reply</span>
				</div>
			</div> <!-- end content -->
			<p>{{$comment->content}}</p>
		</div>								
	</div> <!-- list-commnet -->
	@foreach($comment->list_rep as $rep)
	<div class="cmt-child child-comment">
		<div class="list-commnet list-commnet-child">
			<div class="headr">
				<div class="avt">
					<img src="{{asset('source/p1.jpg')}}">
				</div>

			</div>
			<div class="content-cm">
				<div class="content-head">
					<div class="title">
						<h3>{{$rep->name}}</h3>
						<div class="date">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							@php 
								$time = covert_string_date($rep);
							@endphp
						{{$time['month']}} {{$time['day']}}, {{$time['year']}}
						</div>
					</div>
				</div> <!-- end content -->
				<p>{{$rep->content}}</p>
			</div>								
		</div> <!-- list-commnet-child-->
	</div>
	@endforeach

@endforeach