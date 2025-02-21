// File: src/components/FilmList.jsx

import React, { useState, useEffect } from 'react';
import FilmCardComponent from './FilmCardComponent';
import DateMenuComponent from './DateMenuComponent';
import moment from 'moment';

const MovieDetailsComponent = () => {
  const [films, setFilms] = useState([]); // Состояние всех фильмов
  const [selectedDate, setSelectedDate] = useState(moment().startOf('day')); // Состояние дата меню с датами

  useEffect(() => {
    const fetchFilms = async () => {
      try {
        //Получение всех фильмов
        const response = await fetch('http://localhost:8000/api/films');
        const data = await response.json();
        setFilms(data);
      } catch (error) {
        console.error('Error fetching films:', error);
      }
    };

    fetchFilms();
  }, []);
  // Функция клика на меню дат
  const handleDateChange = (date) => {
    setSelectedDate(date);
  };
 //console.log(selectedDate);
  return (
    <>     
      <DateMenuComponent onDateChange={handleDateChange} /> {/* Передача функции handleDateChange */}    
      <main>
        {films.length > 0 ? (
          <div>
            {films.map(film => (
              <FilmCardComponent key={film.id} filmId={film.id} selectedDate={selectedDate} />
            ))}
          </div>
        ) : (
          <p>Нет доступных фильмов.</p>
        )}
      </main>      
    </>
  );
};

export default MovieDetailsComponent;