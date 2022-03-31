<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><?php echo e(__('Post erstellen')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo e($error); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <form action="<?php echo e(route('post.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Titel</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Inhalt</label>
                            <textarea name="content" id="content" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Bild</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="sendMail" class="form-label">Email senden</label>
                            <input type="checkbox" name="sendMail" id="sendMail">
                        </div>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $.ajax({
        type: "POST",
        url: '<?php echo e(route('post.store')); ?>',
        data: {
            '_token': $("meta[name=csrf-token]").attr('content'),
            'title': 'Mein Test Post',
            'content': 'Das ist mein jQuery Content :)',
            'sendMail': false
        },
        success: function (data) {
            const json = JSON.parse(data);
            console.log(data.message);
            console.log(json);
        },
        dataType: 'json'
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User1\Documents\PHP\blog\resources\views/post/create.blade.php ENDPATH**/ ?>