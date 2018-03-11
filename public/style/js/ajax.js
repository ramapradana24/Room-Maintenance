$(document).ready(function(){

		function load_notif(){
			var link = "{{url('notification/')}}/"+{{$user_in->id}};
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('#notif').html(data)
				},
				error: function(){
					alert('error');
				}
			});
		}

		function load_count_notif(){
			var link = "{{url('notification/')}}/"+{{$user_in->id}}+"/unseen";
			
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('#unseen-notification').html(data)
				},
				error: function(){
					alert('error');
				}
			});
		}

		function load_last_notif(){
			var link = "{{url('notification/')}}/"+{{$user_in->id}}+"/loadlast";
			$.ajax({
				type: 'get',
				url: link,
				success: function(data){
					$('.content-popover').html(data);
				},
				error: function(){
					alert('error');
				}
			});
		}

		load_notif();
		load_count_notif();
		load_last_notif();
		setInterval(function(){
			load_notif();
			load_count_notif();
		}, 3000);

		setInterval(function(){
			load_last_notif();
		}, 5000);
		
	});

	$('.dropdown-toggle').click(function(){
		$('#unseen-notification').html('');
		var link = "{{url('notification/')}}/"+{{$user_in->id}}+"/update";
		$.ajax({
			type: 'get',
			url: link, 
			error: function(){
				alert('error');
			}
		})
	})

	function showSchedule(id){
		var link = "{{url('scheduling/')}}/"+id;
		$.ajax({
			type: 'get',
			url: link,
			success: function(data){
				$('#show-maintenance').html(data);
				$('#modalJadwal').modal('show');
			},
			error: function(){
				alert('error');
			}
		});
	}

	function showComplaint(id){
		var link = "{{url('complaint/')}}/"+id;
		$.ajax({
			type: 'get',
			url: link,
			success: function(data){
				$('#showComplaint').html(data);
				$('#modalPengaduan').modal('show');
			},
			error: function(){
				alert('error');
			}
		});
	}
