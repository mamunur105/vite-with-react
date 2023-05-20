import React from 'react';
import ReactDOM from 'react-dom/client';

const root = ReactDOM.createRoot( document.getElementById( 'cptint_root' ) );

/*
  - Columns is a simple array right now, but it will contain some logic later on. It is recommended by react-table to memoize the columns data
  - Here in this example, we have grouped our columns into two headers. react-table is flexible enough to create grouped table headers
*/


// Render
root.render( `Hello` );
