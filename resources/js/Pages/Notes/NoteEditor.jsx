import React, { useState } from 'react';

export default function NoteEditor({ note }) {
  const [inputText, setInputText] = useState('');  // <-- for user input
  const [summary, setSummary] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSummarize = async () => {
    if (!inputText.trim()) {
      alert('Please enter some text to summarize.');
      return;
    }

    setSummary('');
    setLoading(true);

    try {
      const response = await fetch('/api/ai/summarize', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ content: inputText }),  // send user input here
      });

      if (!response.ok) throw new Error('API request failed');

      const reader = response.body.getReader();
      const decoder = new TextDecoder();
      let done = false;

      while (!done) {
        const { value, done: doneReading } = await reader.read();
        done = doneReading;
        const chunk = decoder.decode(value);
        setSummary(prev => prev + chunk);
      }
    } catch (error) {
      alert('Error contacting AI service');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="p-4 max-w-3xl mx-auto">
      <h1 className="text-2xl font-bold mb-4">AI Note Summarizer</h1>

      <textarea
        className="w-full p-2 border rounded mb-4"
        placeholder="Type or paste any text here to summarize..."
        value={inputText}
        onChange={e => setInputText(e.target.value)}
        rows={8}
      />

      <button
        onClick={handleSummarize}
        disabled={loading}
        className="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        {loading ? 'Summarizing...' : 'Summarize Text'}
      </button>

      {summary && (
        <div className="mt-6 p-4 bg-gray-100 rounded border whitespace-pre-wrap">
          <h2 className="font-semibold mb-2">Summary:</h2>
          <p>{summary}</p>
        </div>
      )}
    </div>
  );
}
