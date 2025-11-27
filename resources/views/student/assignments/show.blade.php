<form action="{{ route('student.assignments.submit', $assignment) }}" 
      method="POST" 
      enctype="multipart/form-data"
      class="mt-6 p-4 border rounded bg-white dark:bg-gray-900">

    @csrf

    <label class="block font-semibold">Upload your work:</label>
    <input type="file" name="file" required class="border p-2 rounded w-full mt-2">

    <label class="block font-semibold mt-4">Comment (optional):</label>
    <textarea name="comment" class="border p-2 rounded w-full"></textarea>

    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
        Submit Assignment
    </button>
</form>
