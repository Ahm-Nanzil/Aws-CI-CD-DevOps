<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_favicon=Utility::getValByName('company_favicon');
    $favicon=Utility::getValByName('company_favicon');
     $getseo= App\Models\Utility::getSeoSetting();
    $metatitle =  isset($getseo['meta_title']) ? $getseo['meta_title'] :'';
    $metsdesc= isset($getseo['meta_desc'])?$getseo['meta_desc']:'';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image'])?$getseo['meta_image']:'';

    $get_cookie = \App\Models\Utility::getCookieSetting();

    $setting = App\Models\Utility::settingsById($form->created_by);
    $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
  if(isset($setting['color_flag']) && $setting['color_flag'] == 'true')
    {
        $themeColor = 'custom-color';
    }
    else {
        $themeColor = $color;
    }
?>

<html lang="en">
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">
<head>
    <title><?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'ERPGO')); ?> - Form Builder</title>

    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metsdesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metsdesc); ?>">
    <meta property="og:image" content="<?php echo e($meta_image.$meta_logo); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metsdesc); ?>">
    <meta property="twitter:image" content="<?php echo e($meta_image.$meta_logo); ?>">

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <link rel="icon" href="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" type="image" sizes="16x16">

    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>" type="image/x-icon"/>

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>">

    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/main.css')); ?>">
    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" id="main-style-link">

    <style>
        :root {
            --color-customColor: <?= $color ?>;    
        }
    </style>

    <link rel="stylesheet" href="<?php echo e(asset('css/custom-color.css')); ?>">
</head>

<body class=" <?php echo e($themeColor); ?>">

    <div class="dash-content">

        <div class="min-vh-100 py-5 d-flex align-items-center">
            <div class="w-100">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-lg-5">
                        <div class="row justify-content-center mb-3">
                            <a class="navbar-brand" href="#">
                                <img src="<?php echo e(asset(Storage::url('uploads/logo/logo-dark.png'))); ?>" class="navbar-brand-img big-logo">
                            </a>
                        </div>
                        <div class="card shadow zindex-100 mb-0">
                            <?php if($form->is_active == 1): ?>
                                <?php echo e(Form::open(array('route'=>array('form.view.store'),'method'=>'post'))); ?>

                                <div class="card-body px-md-5 py-5">
                                    <div class="mb-4">
                                        <h6 class="h3"><?php echo e($form->name); ?></h6>
                                    </div>
                                    <input type="hidden" value="<?php echo e($code); ?>" name="code">
                                    <?php if($objFields && $objFields->count() > 0): ?>
                                        <?php $__currentLoopData = $objFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($objField->type == 'text'): ?>
                                                <div class="form-group">
                                                    <?php echo e(Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::text('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id))); ?>

                                                </div>
                                            <?php elseif($objField->type == 'email'): ?>
                                                <div class="form-group">
                                                    <?php echo e(Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::email('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id))); ?>

                                                </div>
                                            <?php elseif($objField->type == 'number'): ?>
                                                <div class="form-group">
                                                    <?php echo e(Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::number('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id))); ?>

                                                </div>
                                            <?php elseif($objField->type == 'date'): ?>
                                                <div class="form-group">
                                                    <?php echo e(Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::date('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id))); ?>

                                                </div>
                                            <?php elseif($objField->type == 'textarea'): ?>
                                                <div class="form-group">
                                                    <?php echo e(Form::label('field-'.$objField->id, __($objField->name),['class'=>'form-label'])); ?>

                                                    <?php echo e(Form::textarea('field['.$objField->id.']', null, array('class' => 'form-control','required'=>'required','id'=>'field-'.$objField->id))); ?>

                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mt-4 text-end">
                                            
                                            <?php echo e(Form::submit(__('Submit'),array('class'=>'btn btn-primary'))); ?>

                                        </div>
                                        <?php endif; ?>
                                </div>

                                <?php echo e(Form::close()); ?>

                            <?php else: ?>
                                <div class="page-title"><h5><?php echo e(__('Form is not active.')); ?></h5></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($get_cookie['enable_cookie'] == 'on'): ?>
        <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

</body>

</html>
<?php /**PATH /home/ritcoerp/public_html/resources/views/form_builder/form_view.blade.php ENDPATH**/ ?>