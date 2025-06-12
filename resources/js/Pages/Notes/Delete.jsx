import React from 'react';
import { Inertia } from '@inertiajs/inertia';

const Delete = ({ note }) => {
  const handleDelete = () => {
    Inertia.delete(route('notes.destroy', note.id), {
      onSuccess: () => {
        Inertia.visit(route('notes.index'));
      },
    });
  };

  const handleCancel = () => {
    Inertia.visit(route('notes.index'));
  };

  return (
    <div className="max-w-md mx-auto mt-20 p-6 border rounded shadow">
      <h2 className="text-xl font-semibold mb-4">Confirm Delete</h2>
      <p>Are you sure you want to delete this note?</p>
      <p className="italic my-4">"{note.title}"</p>
      <div className="flex justify-between">
        <button
          onClick={handleDelete}
          className="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
        >
          Delete
        </button>
        <button
          onClick={handleCancel}
          className="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400"
        >
          Cancel
        </button>
      </div>
    </div>
  );
};

export default Delete;
