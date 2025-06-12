import React from "react";
import { usePage, Link } from "@inertiajs/react";
import { route } from "ziggy-js";

export default function Index({ notes }) {
  const { flash = {} } = usePage().props;

  return (
    <div className="p-4 max-w-3xl mx-auto">
      <h1 className="text-2xl font-bold mb-4">My Notes</h1>

      {flash.success && (
        <div className="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
          {flash.success}
        </div>
      )}

      <div className="flex justify-end mb-4">
        <Link
          href={route("notes.create")}
          className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          + New Note
        </Link>
      </div>

      {notes.length === 0 ? (
        <p className="text-gray-600">No notes found.</p>
      ) : (
        <ul className="space-y-4">
          {notes.map((note) => (
            <li key={note.id} className="border p-4 rounded shadow">
              <h2 className="text-xl font-semibold mb-2">{note.title}</h2>
              <p className="text-gray-700">{note.content}</p>
              <div className="mt-4 flex space-x-2">
                <Link
                  href={route("notes.edit", note.id)}
                  className="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500"
                >
                  Edit
                </Link>
                <Link
                  method="delete"
                  href={route("notes.destroy", note.id)}
                  as="button"
                  className="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                >
                  Delete
                </Link>
              </div>
            </li>
          ))}
        </ul>
      )}
    </div>
  );
}
