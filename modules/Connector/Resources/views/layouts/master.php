<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php echo $__env->make('layouts.partials.google_analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Connector</title>

       
       

    </head>
    <body>
        <?php echo $__env->yieldContent('content'); ?>

        
        
    </body>
</html>
