<?php $__env->startSection('page-title', __('Case')); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create case')): ?>
        <div class="text-sm-end d-flex all-button-box justify-content-sm-end mx-1">
            <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('case.file.import')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Import customer CSV file')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-file-import"></i>
            </a>
            <a href="<?php echo e(route('cases.export')); ?>" class="btn btn-sm btn-primary mx-1" data-bs-toggle="tooltip"
                data-title=" <?php echo e(__('Export')); ?>" title="<?php echo e(__('Export')); ?>">
                <i class="ti ti-file-export"></i>
            </a>
            <a href="<?php echo e(route('cases.create')); ?>" class="btn btn-sm btn-primary " data-toggle="tooltip"
                title="<?php echo e(__('Create Case')); ?>" data-bs-original-title="<?php echo e(__('Add Case')); ?>" data-bs-placement="top"
                data-bs-toggle="tooltip">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><?php echo e(__('Case')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row p-0">
        <div class="col-xl-12">

            <div class="card-header card-body table-border-style">
                <h5></h5>
                <div class="table-responsive">
                    <table class="table dataTable">
                        <thead>
                            <tr>
                                <th><?php echo e(__('S.No.')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Case No.')); ?></th>
                                <th><?php echo e(__('Year')); ?></th>
                                <th><?php echo e(__('Courts/Tribunal')); ?></th>
                                <th><?php echo e(__('Advocate')); ?></th>
                                <th><?php echo e(__('Date of filing')); ?></th>
                                <th width="100px"><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><?php echo e($case->title); ?></td>


                                <td>
                                    <?php echo e(!empty($case->case_number) ? $case->case_number : ' '); ?>

                                </td>
                                <td>
                                    <?php echo e(!empty($case->year) ? $case->year : '2023'); ?>

                                </td>

                                <td>
                                    <a href="<?php echo e(route('cases.show', $case->id)); ?>" class="btn btn-sm" data-title="<?php echo e(__('View Case')); ?>">
                                        <?php echo e(App\Models\CauseList::getCourtById($case->court)); ?>

                                    </a>
                                </td>

                                <td><?php echo e(App\Models\Advocate::getAdvocates($case->advocates)); ?></td>
                                <td><?php echo e(date('d-m-Y',strtotime($case->filing_date))); ?></td>
                                <td>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view case')): ?>
                                        <div class="action-btn bg-light-secondary ms-2">
                                            <a href="<?php echo e(route('cases.show', $case->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                data-title="<?php echo e(__('View Cause')); ?>"
                                                title="<?php echo e(__('View')); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top"><i class="ti ti-eye "></i></a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit case')): ?>
                                        <div class="action-btn bg-light-secondary ms-2">
                                            <a href="<?php echo e(route('cases.edit', $case->id)); ?>"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                title="<?php echo e(__('Edit')); ?>" data-bs-toggle="tooltip"
                                                data-bs-placement="top">
                                                <i class="ti ti-edit "></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="action-btn bg-light-secondary ms-2">
                                        <a href="<?php echo e(route('cases.journey', $case->id)); ?>"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                            title="<?php echo e(__('Case Journey')); ?>" data-bs-toggle="tooltip"
                                            data-bs-placement="top">
                                            <i class="ti ti-affiliate"></i>
                                        </a>
                                    </div>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete case')): ?>
                                        <div class="action-btn bg-light-secondary ms-2">
                                            <a href="#"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center bs-pass-para"
                                                data-confirm="<?php echo e(__('Are You Sure?')); ?>"
                                                data-confirm-yes="delete-form-<?php echo e($case->id); ?>"
                                                title="<?php echo e(__('Delete')); ?>" data-bs-toggle="tooltip"
                                                data-text="<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>"
                                                data-bs-placement="top">
                                                <i class="ti ti-trash"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php echo Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['cases.destroy', $case->id],
                                        'id' => 'delete-form-' . $case->id,
                                    ]); ?>

                                    <?php echo Form::close(); ?>

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


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\advocatego\resources\views/cases/index.blade.php ENDPATH**/ ?>