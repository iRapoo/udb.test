<?php require 'views/' . $_GET['view'] . '/index.php' ?>

<?php require 'views/header.php' ?>

<div class="container">

        <div class="col-lg-8 col-lg-offset-2 block-center">

            <h1 class="text-center">Регистрация</h1>

            <form id="contact-form" method="post" enctype="multipart/form-data" role="form">

                <div class="messages"></div>

                <div class="controls">

                    <div class="col-md-6 block-center">
                        <div class="form-group">
                            <label for="form_name">Имя *</label>
                            <input id="form_name" type="text" name="name" class="form-control"
                                   placeholder="Укажите Ваше имя *" required="required"
                                   data-error="Имя указать обязательно.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6 block-center">
                        <div class="form-group">
                            <label for="form_email">Email *</label>
                            <input id="form_email" type="email" name="email" class="form-control"
                                   placeholder="Укажите Ваш Email *" required="required"
                                   data-error="Email указать обязательно.">
                            <div class="help-block with-errors check-email"></div>
                        </div>
                    </div>

                    <div class="col-md-6 block-center">
                        <div class="form-group">
                            <label for="form_photo">Фото *</label>
                            <input id="form_photo" type="file" name="photo" class="form-control"
                                   placeholder="Выбрать фото *" required="required" data-error="Фото обязательно.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-md-6 block-center">
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA ?>"></div>
                        </div>
                    </div>

                    <div class="col-md-6 block-center">
                        <input type="submit" class="btn btn-success btn-send" value="Зарегестрировать">
                    </div>

                </div>

            </form>

        </div>

</div>

<?php require 'views/footer.php' ?>
