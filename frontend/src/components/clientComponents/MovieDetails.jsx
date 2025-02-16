// File: src/components/FilmList.jsx

import React, { useState, useEffect } from 'react';
import FilmCard from './FilmCard';
import DateMenu from './DateMenu';
import moment from 'moment';

const MovieDetails = () => {
  const [films, setFilms] = useState([]);
  const [selectedDate, setSelectedDate] = useState(moment().startOf('day'));

  useEffect(() => {
    const fetchFilms = async () => {
      try {
        const response = await fetch('http://localhost:8000/api/films');
        const data = await response.json();
        setFilms(data);
      } catch (error) {
        console.error('Error fetching films:', error);
      }
    };

    fetchFilms();
  }, []);

  const handleDateChange = (date) => {
    setSelectedDate(date);
  };

  return (
    <>     
      <DateMenu onDateChange={handleDateChange} /> {/* Передача функции handleDateChange */}    
      <main>
        {films.length > 0 ? (
          <div>
            {films.map(film => (
              <FilmCard key={film.id} filmId={film.id} selectedDate={selectedDate} />
            ))}
          </div>
        ) : (
          <p>Нет доступных фильмов.</p>
        )}
      </main>      
    </>
  );
};

export default MovieDetails;