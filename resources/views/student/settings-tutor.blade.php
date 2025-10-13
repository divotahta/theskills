@extends('layouts.student-tutor')

@section('content')
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
                <p class="text-gray-600 mt-2">Manage your account settings and preferences</p>
            </div>
        </div>
    </div>

    <!-- Settings Sections -->
    <div class="space-y-6">
        <!-- Account Settings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Account Settings</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Notifications</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="email-notifications" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="email-notifications" class="ml-2 text-sm text-gray-700">Receive email notifications about course updates</label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Learning Reminders</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="learning-reminders" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="learning-reminders" class="ml-2 text-sm text-gray-700">Send me daily learning reminders</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Privacy Settings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Privacy Settings</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Visibility</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Learning Progress</label>
                        <div class="flex items-center">
                            <input type="checkbox" id="show-progress" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="show-progress" class="ml-2 text-sm text-gray-700">Show my learning progress to others</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Learning Preferences -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Learning Preferences</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Language</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="en">English</option>
                            <option value="id">Indonesian</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Video Quality</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="auto">Auto</option>
                            <option value="720p">720p</option>
                            <option value="1080p">1080p</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-xl shadow-sm border border-red-200">
            <div class="px-6 py-4 border-b border-red-200">
                <h2 class="text-xl font-semibold text-red-900">Danger Zone</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Account</h3>
                        <p class="text-sm text-gray-600 mb-4">Once you delete your account, there is no going back. Please be certain.</p>
                        <button class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                            Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="mt-8 flex justify-end">
        <button class="px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
            Save Changes
        </button>
    </div>
@endsection
