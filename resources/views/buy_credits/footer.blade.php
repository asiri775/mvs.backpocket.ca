<section>
    <script>
        $(document).ready(function () {
            $(document).on('submit', 'form', function () {
                $('button').attr('disabled', 'disabled');
            });


            $(".trial_link").on('click', function(){
                $("#trial_form button").click();
            });
        });
    </script>
</section>