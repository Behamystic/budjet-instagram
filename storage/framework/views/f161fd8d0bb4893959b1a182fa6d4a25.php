<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-gray-800">Task Manager</h1>
                <nav class="hidden md:ml-6 md:flex space-x-4">
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="<?php echo e(route('tasks.index')); ?>" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Tasks</a>
                </nav>
            </div>
            <div class="flex items-center">
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=<?php echo e(Auth::user()->first_name); ?>+<?php echo e(Auth::user()->last_name); ?>&background=0D8ABC&color=fff" alt="User avatar">
                        <span class="text-gray-700 text-sm font-medium hidden md:block"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></span>
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <!-- Dropdown menu (hidden by default) -->
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <a href="<?php echo e(route('logout')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Dashboard Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            <?php if(Auth::check()): ?>
                <p class="text-gray-600">Welcome back, <?php echo e(Auth::user()->first_name); ?>! Here's an overview of your tasks.</p>
            <?php else: ?>
                <p class="text-gray-600">Welcome back, Guest! Here's an overview of your tasks.</p>
            <?php endif; ?>
        </div>
        

        <!-- Stats Cards -->
        <<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Tasks -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                        <p class="text-2xl font-semibold text-gray-800"><?php echo e($totalTasks); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Completed Tasks -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Completed</p>
                        <p class="text-2xl font-semibold text-gray-800"><?php echo e($completedTasks); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- In Progress Tasks -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">In Progress</p>
                        <p class="text-2xl font-semibold text-gray-800"><?php echo e($inProgressTasks); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        

        <!-- Recent Tasks Section -->
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-800">Recent Tasks</h3>
                <a href="<?php echo e(route('tasks.index' )); ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
            </div>
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
                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($task->task_name); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($task->priority == 'High' ? 'bg-red-100 text-red-800' :
                                        ($task->priority == 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')); ?>">
                                        <?php echo e($task->priority); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($task->due_date); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($task->status == 'not-started' ? 'bg-gray-100 text-gray-800' :
                                        ($task->status == 'in-progress' ? 'bg-yellow-100 text-yellow-800' : 
                                        ($task->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'))); ?>">
                                        <?php echo e(ucfirst($task->status)); ?>

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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <!-- Quick Add Task -->
        <form action="<?php echo e(route('tasks.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="col-span-3 md:col-span-1">
                    <label for="task-name" class="block text-sm font-medium text-gray-700 mb-2">Task Name</label>
                    <input type="text" id="task-name" name="task_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter task name" value="<?php echo e(old('task_name')); ?>" required>
                </div>
        
                <!-- Priority Select -->
                <div class="col-span-3 md:col-span-1">
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select id="priority" name="priority" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="low" <?php echo e(old('priority') == 'low' ? 'selected' : ''); ?>>Low</option>
                        <option value="medium" <?php echo e(old('priority') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                        <option value="high" <?php echo e(old('priority') == 'high' ? 'selected' : ''); ?>>High</option>
                    </select>
                </div>
        
                <!-- Status Select -->
                <div class="col-span-3 md:col-span-1">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="pending" <?php echo e(old('status') == 'not-started' ? 'selected' : ''); ?>>Not Started</option>
                        <option value="in_progress" <?php echo e(old('status') == 'in-    progress' ? 'selected' : ''); ?>>In Progress</option>
                        <option value="completed" <?php echo e(old('status') == 'completed' ? 'selected' : ''); ?>>Completed</option>
                    </select>
                </div>
        
                <!-- Other inputs (due date, description, etc.) -->
                <div class="col-span-3 md:col-span-1">
                    <label for="due-date" class="block text-sm font-medium text-gray-700 mb-2">Due Date</label>
                    <input type="date" id="due-date" name="due_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?php echo e(old('due_date')); ?>">
                </div>
        
                <div class="col-span-3">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter task description"><?php echo e(old('description')); ?></textarea>
                </div>
            </div>
        
            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    Add Task
                </button>
            </div>
        </form>
        
        
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>


    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">© 2025 Task Manager. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle user dropdown menu
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');
        
        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });
        
        // Close the dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html><?php /**PATH /home/azizbek/Desktop/ORM/resources/views/dashboard.blade.php ENDPATH**/ ?>