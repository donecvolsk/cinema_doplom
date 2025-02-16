import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './layouts/client/css/styles.css';
import MovieDetails from './components/clientComponents/MovieDetails';
import CinemaHall from './components/clientComponents/CinemaHall';
import BookingForm from './components/clientComponents/BookingForm';



function App() {
  return (
    <>
    <header className="page-header">
      <h1 className="page-header__title" >Идём<span>в</span>кино</h1>      
    </header>
    <Router>
            <Routes>
                <Route path="/" element={<MovieDetails />} />
                <Route path="hall" element={<CinemaHall />} />
                <Route path="payment" element={<BookingForm />} />
            </Routes>
        </Router>
    </>


  );
}

export default App;
