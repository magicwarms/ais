$(".form_input_class").on('submit',function() {
        console.log("ini update wak");
        var method = $('input#method').val();
        $.ajax({
          type: method,
          headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
          },
          url: "{{ route('class.update') }}",
          data: $(this).serialize(),
          dataType: 'JSON',
          cache: false,
          beforeSend: function(){
              altair_helpers.content_preloader_show('md');
          },
          success: function(result) {
            $('.form_input_class')[0].reset();
            $('input#id').val('');
            $('input#method').val('POST');
            $('#input_submit_type').html('<input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary">');
            $('#data_table').DataTable().ajax.reload();
            altair_helpers.content_preloader_hide();
            $("#form-tab").removeClass("uk-active")
            $('.list_class')[0].click();
            $("#list-tab").addClass("uk-active")
            if(result.status=='success'){
              UIkit.notify({
                message: result.msg,
                status: 'success',
                timeout: 8000,
                pos: 'top-center'
              });
            }
          },
          error: function (result) {
            var response = JSON.parse(result.responseText)
            $.each(response.errors, function (key, value) {
                UIkit.notify({
                message: value,
                status: 'warning',
                timeout: 10000,
                pos: 'top-center'
              });
            });
            altair_helpers.content_preloader_hide();
          }
        });
        event.preventDefault();
      });

      $(".form_input_teacher").on('submit',function() {
          var method = $('input#method').val();
          $.ajax({
            type: method,
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            url: "{{ route('teacher.update') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($(this)[0]),
            dataType: 'JSON',
            beforeSend: function(){
                altair_helpers.content_preloader_show('md');
            },
            success: function(result) {
              $('.form_input_teacher')[0].reset();
              $('input#id').val('');
              $('input#method').val('POST');
              $('#input_submit_type').html('<input id="save_item" type="submit" value="SAVE" class="md-btn md-btn-primary">');
              $('#data_table').DataTable().ajax.reload();
              altair_helpers.content_preloader_hide();
              $("#form-tab").removeClass("uk-active")
              $('.list_teacher')[0].click();
              $("#list-tab").addClass("uk-active")
              if(result.status=='success'){
                UIkit.notify({
                  message: result.msg,
                  status: 'success',
                  timeout: 8000,
                  pos: 'top-center'
                });
              }
            },
            error: function (result) {
              var response = JSON.parse(result.responseText)
              $.each(response.errors, function (key, value) {
                  UIkit.notify({
                  message: value,
                  status: 'warning',
                  timeout: 10000,
                  pos: 'top-center'
                });
              });
              altair_helpers.content_preloader_hide();
            }
          });
          event.preventDefault(); 
        });