import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './layouts/client/css/styles.css';
import MovieDetailsComponent from './components/clientComponents/MovieDetailsComponent';
import HallComponent from './components/clientComponents/HallComponent';
import BookingForm from './components/clientComponents/BookingForm';



function App() {
  return (
    <>
    <header className="page-header">
      <h1 className="page-header__title" >Идём<span>в</span>кино</h1>      
    </header>
    <Router>
            <Routes>
                <Route path="/" element={<MovieDetailsComponent />} />
                <Route path="hall/:sessionId" element={<HallComponent />} />
                <Route path="payment" element={<BookingForm />} />
            </Routes>
        </Router>
    </>


  );
}

export default App;
