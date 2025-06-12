import React, { useState } from 'react';

export default function GenerateTags({ note }) {
  const [tags, setTags] = useState('');
  const [loading, setLoading] = useState(false);

  const handleGenerateTags = async () => {
    setLoading(true);
    try {
      const response = await fetch('/ai/generate-tags', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ content: note.content }),
      });

      const data = await response.json();
      if (response.ok) {
        setTags(data.tags);
      } else {
        alert(data.error || 'Tag generation failed');
      }
    } catch (error) {
      alert('Something went wrong');
    }
    setLoading(false);
  };

  return (
    <div className="p-4 max-w-2xl mx-auto">
      <h1 className="text-xl font-bold mb-2">Generate Tags for: {note.title}</h1>
      <p className="mb-4 bg-gray-100 p-3 rounded border">{note.content}</p>

      <button
        onClick={handleGenerateTags}
        disabled={loading}
        className="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
      >
        {loading ? 'Generating Tags...' : 'Generate Tags'}
      </button>

      {tags && (
        <div className="mt-4 p-3 bg-blue-100 border border-blue-300 rounded">
          <strong>AI Suggested Tags:</strong> {tags}
        </div>
      )}
    </div>
  );
}
