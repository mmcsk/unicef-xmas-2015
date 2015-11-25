$('document').ready(function() {
	$('.save').click(function() {
		var voteId = $(this).siblings('.vote-id').val();
		var assignTo = $(this).siblings('.assign-to').val();

		console.log(voteId, assignTo);

		if (!parseInt(assignTo)) {
			$(this).removeClass('btn-default').addClass('btn-warning');
			return false;
		}

		var me = this;

		$.post('/admin/save-vote', {
			vote_id: voteId,
			assign_to: assignTo
		}, function(res) {
			var result = JSON.parse(res);

			if (result.status) {
				$(me).removeClass('btn-default, btn-warning').addClass('btn-success');
				setTimeout(function() {
					$(me).parents('tr').hide('slow');
				}, 2000);
			}
			else {
				$(me).removeClass('btn-default, btn-warning').addClass('btn-danger');
			}
		});
	});
});


// Vlado Eckert 0903 604 360