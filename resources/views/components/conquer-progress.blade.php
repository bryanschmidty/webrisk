<div class="conquer-progress my-4" aria-label="Conquer progress">
    <div class="mb-1 text-sm">{{ $conquered }} / {{ $limit }} conquered</div>
    <div class="w-full bg-gray-200 h-2 rounded">
        <div class="bg-indigo-600 h-2 rounded" style="width: {{ $percent }}%"></div>
    </div>
</div>

