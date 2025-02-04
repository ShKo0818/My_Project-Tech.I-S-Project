

<?php $__env->startSection('title', '商品登録'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>商品登録</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row"> 
        <div class="col-md-10">
            <?php if($errors->any()): ?> 
                <div class="alert alert-danger">
                    <ul>
                       <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li><?php echo e($error); ?></li>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card card-primary">
                <form method="POST" action="<?php echo e(route('item.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" required>
                        </div>

                        <div class="form-group">
                            <label for="category">カテゴリ</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">選択してください</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->name); ?>" <?php echo e(old('category') == $category->name ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                        </div>

                        <div class="form-group">
                            <label for="company_name">メーカー名</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" 
                            <?php if(Auth::user()->user_type === 'corporate'): ?>
                                value="<?php echo e(Auth::user()->company_name); ?>" readonly
                            <?php else: ?>
                                placeholder="メーカー名を入力"
                            <?php endif; ?>>
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">￥</span>
                                </div>
                                <input type="number" class="form-control" id="price" name="price" placeholder="価格を入力" required min="1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">画像</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/item/create.blade.php ENDPATH**/ ?>