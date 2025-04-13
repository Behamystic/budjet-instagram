<?php $__env->startSection('title', 'Task Details'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Tasks Header -->
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tasks</h2>
                <p class="text-gray-600">Manage your tasks</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="<?php echo e(route('tasks.create')); ?>"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>
                    New Task
                </a>
            </div>
        </div>

        <!-- Filters and Search -->
        


        <!-- Tasks Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Task</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?php echo e($task->task_name); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php if($task->priority == 'High'): ?> bg-red-100 text-red-800
                                    <?php elseif($task->priority == 'Medium'): ?> bg-yellow-100 text-yellow-800
                                    <?php else: ?> bg-green-100 text-green-800 <?php endif; ?>">
                                    <?php echo e($task->priority); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($task->due_date); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php if($task->status == 'Overdue'): ?> bg-red-100 text-red-800
                                    <?php elseif($task->status == 'In Progress'): ?> bg-yellow-100 text-yellow-800
                                    <?php elseif($task->status == 'Completed'): ?> bg-green-100 text-green-800
                                    <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                                    <?php echo e($task->status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No tasks found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        
            <!-- Pagination -->
            <div class="px-6 py-3">
                <?php echo e($tasks->links()); ?>

            </div>
        </div>
        
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.task', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/behruz/Документы/ORM/resources/views/task_crud/index.blade.php ENDPATH**/ ?>