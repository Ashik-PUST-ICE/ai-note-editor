import React, { useState } from 'react';

export default function TagGenerator() {
  const [content, setContent] = useState('');
  const [tags, setTags] = useState([]);
  const [loading, setLoading] = useState(false);

  const handleGenerateTags = async () => {
    setLoading(true);
    try {
      const response = await fetch('/api/ai/tags', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ content }),
      });

      const data = await response.json();

      if (response.ok) {
        setTags(data.tags);
      } else {
        alert(data.error || 'Failed to generate tags');
      }
    } catch (err) {
      alert('Error contacting AI service');
    }
    setLoading(false);
  };

  return (
    <div className="p-6 max-w-xl mx-auto">
      <h2 className="text-xl font-bold mb-4">AI Tag Generator</h2>

      <textarea
        className="w-full p-3 border rounded mb-4"
        rows="6"
        placeholder="Enter your note content here..."
        value={content}
        onChange={(e) => setContent(e.target.value)}
      />

      <button
        onClick={handleGenerateTags}
        disabled={loading || !content.trim()}
        className="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
      >
        {loading ? 'Generating...' : 'Generate Tags'}
      </button>

      {tags.length > 0 && (
        <div className="mt-6">
          <h3 className="font-semibold mb-2">Generated Tags:</h3>
          <div className="flex flex-wrap gap-2">
            {tags.map((tag, index) => (
              <span key={index} className="bg-gray-200 text-sm px-3 py-1 rounded">
                #{tag}
              </span>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
