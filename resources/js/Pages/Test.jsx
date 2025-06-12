// resources/js/Pages/Test.jsx
import React from 'react';
import NoteEditor from './Notes/NoteEditor';

export default function Test() {
  const dummyNote = {
    id: 1,
    title: 'My Test Note',
    content: 'Laravel is a web application framework with expressive, elegant syntax...',
  };

  return <NoteEditor note={dummyNote} />;
}
