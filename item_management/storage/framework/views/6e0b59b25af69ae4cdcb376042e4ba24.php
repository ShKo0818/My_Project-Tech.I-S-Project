<?php $__env->startSection('title', '商品一覧'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>商品一覧</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>

                    <!-- 商品検索フォーム -->
                    <form action="<?php echo e(route('item.index')); ?>" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="商品名を入力">
                            <select name="match" class="form-select">
                                <option value="partial">あいまい検索</option>
                                <option value="exact">完全一致</option>
                            </select>
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </form>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>画像</th>
                                <th>価格</th> <!-- 価格の列を追加 -->
                                <th>メーカー名</th>
                                <th>操作</th> <!-- 編集・削除の列を追加 -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->id); ?></td>
                                    <td><a href="<?php echo e(route('item.show', $item->id)); ?>"><?php echo e($item->name); ?></a></td>
                                    <td><?php echo e($item->category); ?></td>
                                    <td><?php echo e($item->detail); ?></td>
                                    <td><?php if($item->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $item->image)); ?>" alt="商品画像" class="img-fluid" style="max-width: 200px;">
                                        <?php else: ?>
                                        <p>画像がありません</p>
                                       <?php endif; ?>
                                    </td> <!-- 大きな画像表示 -->
                                    <td>
                                        <?php if($item->price): ?>
                                            ¥<?php echo e(number_format($item->price)); ?> <!-- 価格表示 -->
                                        <?php else: ?>
                                            価格未設定
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->company_name); ?></td>

                                    <td>
                                        <form action="<?php echo e(route('cart.add')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                                            <input type="hidden" name="name" value="<?php echo e($item->name); ?>">
                                            <input type="hidden" name="price" value="<?php echo e($item->price); ?>">
                                            <input type="hidden" name="image" value="<?php echo e(asset('storage/' . $item->image)); ?>">

                                            <input type="number" name="quantity" value="1" min="1" class="form-control" style="width: 60px; display:inline;">
                                            <button type="submit" class="btn btn-sm btn-success">カートに追加</button>
                                        </form>
                                    </td>
                                    <td>
                                        <?php
                                            $userType = auth()->user()->user_type; // ユーザーの種類を取得
                                            $isOwner = auth()->user()->company_id === $item->company_id; // 法人ユーザーの場合、自社商品かどうか判定
                                        ?>

                                        <?php if($userType === 'master' || ($userType === 'corporate' && $isOwner)): ?>
                                            <!-- 編集ボタン -->
                                            <a href="<?php echo e(route('item.edit', $item->id)); ?>" class="btn btn-sm btn-primary">編集</a>

                                            <!-- 削除ボタン -->
                                            <form action="<?php echo e(route('item.destroy', $item->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('本当に削除しますか？');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">削除</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\pro-team-item-management-laravel10\item_management\resources\views/item/index.blade.php ENDPATH**/ ?>