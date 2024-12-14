<div class="bg-white shadow-lg max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
        <h3 class="text-2xl font-bold text-black text-center">Exam Details</h3>
    </div>

    @if($selectedExam)
        <!-- Content Section -->
        <div class="p-6">
            <!-- Top row for key details -->
            <div class="flex justify-between space-x-4 bg-gray-50 p-4 mb-6">
                <div class="text-center flex-1">
                    <span class="block text-sm font-medium text-gray-600">Category</span>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $selectedExam->examCategory->name ?? 'N/A' }}
                    </p>
                </div>
                <div class="text-center flex-1">
                    <span class="block text-sm font-medium text-gray-600">Total Questions</span>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $selectedExam->total_question }}
                    </p>
                </div>
                <div class="text-center flex-1">
                    <span class="block text-sm font-medium text-gray-600">Passing %</span>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $selectedExam->passing_percentage }}%
                    </p>
                </div>
            </div>

            <!-- Exam Description -->
            <div class="bg-gray-50 border border-gray-200 p-4 mb-6">
                <div class="text-lg font-semibold text-gray-700 mb-2">Exam Description</div>
                <div class="bg-white p-4 shadow-inner">
                    <p class="text-gray-900 leading-relaxed">
                        {!! $selectedExam->description ?? 'No description provided' !!}
                    </p>
                </div>
            </div>

            <!-- Additional Details using flex for grouping fields in one line -->
            <div class="space-y-4">
                <!-- Exam Date and Exam Expiry Date in the same line -->
                <div class="flex justify-between space-x-4">
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Exam Date</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($selectedExam->exam_date)->format('d M Y H:i:s') }}
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Exam Expiry Date</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($selectedExam->exam_expire_date)->format('d M Y H:i:s') }}
                        </p>
                    </div>
                </div>

                <!-- Duration and Total Score in the same line -->
                <div class="flex justify-between space-x-4">
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Duration</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $selectedExam->duration }} minutes
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Total Score</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $selectedExam->total_score }}
                        </p>
                    </div>
                </div>

                <!-- Time Limit Per Question and Result Published in the same line -->
                <div class="flex justify-between space-x-4">
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Time Limit Per Question</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $selectedExam->time_limit_per_question }} seconds
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Result Published</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $selectedExam->result_published ? 'Yes' : 'No' }}
                        </p>
                    </div>
                </div>

                <!-- Status and Created By in the same line -->
                <div class="flex justify-between space-x-4">
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Status</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $selectedExam->status }}
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded flex-1">
                        <span class="block text-sm font-medium text-gray-600">Created By</span>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $selectedExam->createdBy->name ?? 'Unknown' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
