<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><?php echo e(__('Posts')); ?></div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Benutzer</th>
                            <th scope="col">Kategorien</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Aktionen</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <th scope="row">
                                    <?php if($post->image_path && $post->user_id === auth()->id()): ?>
                                        <img src="<?php echo e(route('post.image', ['post' => $post->id])); ?>" alt="Image" height="75" width="75">
                                    <?php else: ?>
                                        <?php echo e($post->id); ?>

                                    <?php endif; ?>
                                </th>
                                <td><?php echo e($post->title); ?></td>
                                <td><?php echo e($post->user?->name); ?></td>
                                <td>
                                    <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-primary"><?php echo e($category->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($post->created_at); ?></td>
                                <td>
                                    <a href="<?php echo e(route('post.show', ['post' => $post->id])); ?>" class="btn btn-sm btn-success">Anzeigen</a>
                                    <a href="<?php echo e(route('post.edit', ['id' => $post->id])); ?>" class="btn btn-sm btn-primary">Bearbeiten</a>
                                    <a href="<?php echo e(route('post.image', ['post' => $post->id])); ?>" class="btn btn-sm btn-primary" target="_blank">Bild</a>
                                    <form action="<?php echo e(route('post.destroy')); ?>" method="POST" onsubmit="return confirm('Möchtest du den Post wirklich löschen?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <input type="hidden" name="id" value="<?php echo e($post->id); ?>">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Löschen">
                                    </form>
                                </td>
                              </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>

                      <?php echo e($posts->links()); ?>


                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User1\Documents\PHP\blog\resources\views/post/index.blade.php ENDPATH**/ ?>