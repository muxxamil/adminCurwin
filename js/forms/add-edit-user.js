$('.add-edit-user').each(function(){
	$(this).validate({
		submitHandler: function(form) {
			var $form = $(form),
			$messageError = $form.find('#add-edit-user-error');
			$messageSuccess = $form.find('#add-edit-user-success');

			// Fields Data
			var formData = $form.serializeArray(),
				data = {};

			$(formData).each(function(index, obj){
			    data[obj.name] = obj.value;
			});

			// Ajax Submit
			$.ajax({
				type: 'POST',
				url: $form.attr('action'),
				data: data
			}).always(function(data, textStatus, jqXHR) {
				data = JSON.parse(data);
				if(!data || data.status != 200) {
					$messageError.removeClass('d-none');
					$messageSuccess.addClass('d-none');
				} else {
					$messageSuccess.removeClass('d-none');
					$messageError.addClass('d-none');
				}
			});
		}
	});
});