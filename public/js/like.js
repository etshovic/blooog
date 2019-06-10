$(document).ready(function(){

	$('.like').on('click',function(){
		var like_s = $(this).attr('data-like');
		var post_id = $(this).attr('data-postid');
		var post_id = post_id.slice(0,-2);
		// alert(post_id);
		$.ajax({
			type:'POST',
			url: url,
			data:{
				like_s : like_s ,
				post_id : post_id ,
				_token : token 
			},
			success: function (data)
			{
				if (data.is_like == 1)
				{
					$('*[data-postid="' +  post_id  +'_l"]')
					.removeClass('btn-secondary')
					.addClass('btn-success');
					$('*[data-postid="' +  post_id  +'_u"]')
					.removeClass('btn-danger')
					.addClass('btn-secondary');

					var curr_like = $('*[data-postid="' +  post_id  +'_l"]').find('.like_count').text();
					var new_like = parseInt(curr_like) + 1 ;
					$('*[data-postid="' +  post_id  +'_l"]').find('.like_count').text(new_like);

					if (data.change_like == 1) {
						var curr_unlike = $('*[data-postid="' +  post_id  +'_u"]').find('.unlike_count').text();
						var new_unlike = parseInt(curr_unlike) - 1 ;
						$('*[data-postid="' +  post_id  +'_u"]').find('.unlike_count').text(new_unlike);
					}
				}
				if (data.is_like == 0)
				{
					$('*[data-postid="' +  post_id  +'_l"]')
					.removeClass('btn-success')
					.addClass('btn-secondary');

					var curr_like = $('*[data-postid="' +  post_id  +'_l"]').find('.like_count').text();
					var new_like = parseInt(curr_like) - 1 ;
					$('*[data-postid="' +  post_id  +'_l"]').find('.like_count').text(new_like);
				}
			}
		});
	});


	$('.unlike').on('click',function(){
		var like_s = $(this).attr('data-like');
		var post_id = $(this).attr('data-postid');
		var post_id = post_id.slice(0,-2);
		// alert(post_id);
		$.ajax({
			type:'POST',
			url: url_dis,
			data:{
				like_s : like_s ,
				post_id : post_id ,
				_token : token 
			},
			success: function (data)
			{
				if (data.is_unlike == 1)
				{
					$('*[data-postid="' +  post_id  +'_u"]')
					.removeClass('btn-secondary')
					.addClass('btn-danger');
					$('*[data-postid="' +  post_id  +'_l"]')
					.removeClass('btn-success')
					.addClass('btn-secondary');


					var curr_unlike = $('*[data-postid="' +  post_id  +'_u"]').find('.unlike_count').text();
					var new_unlike = parseInt(curr_unlike) + 1 ;
					$('*[data-postid="' +  post_id  +'_u"]').find('.unlike_count').text(new_unlike);

					if (data.change_unlike == 1) {
						var curr_like = $('*[data-postid="' +  post_id  +'_l"]').find('.like_count').text();
						var new_like = parseInt(curr_like) - 1 ;
						$('*[data-postid="' +  post_id  +'_l"]').find('.like_count').text(new_like);
					}

				}
				if (data.is_unlike == 0)
				{
					$('*[data-postid="' +  post_id  +'_u"]')
					.removeClass('btn-danger')
					.addClass('btn-secondary');

					var curr_unlike = $('*[data-postid="' +  post_id  +'_u"]').find('.unlike_count').text();
					var new_unlike = parseInt(curr_unlike) - 1 ;
					$('*[data-postid="' +  post_id  +'_u"]').find('.unlike_count').text(new_unlike);
				}
			}
		});
	});

});
