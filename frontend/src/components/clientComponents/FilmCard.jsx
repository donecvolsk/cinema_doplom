import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import moment from 'moment';

const FilmCard = ({ filmId, selectedDate }) => {
  const [film, setFilm] = useState(null);

  useEffect(() => {
    const fetchFilm = async () => {
      try {
        const response = await fetch(`http://localhost:8000/api/films/${filmId}`);
        const data = await response.json();
        setFilm(data);
      } catch (error) {
        console.error('Error fetching film details:', error);
      }
    };

    fetchFilm();
  }, [filmId]);

  if (!film) {
    return <div>Loading...</div>;
  }

  // Группируем сессии по залам
  const groupedSessions = film.sessions.reduce((acc, session) => {
    const sessionDate = moment(session.start_time);
    if (sessionDate.isSame(selectedDate, 'day')) {
      const hallName = session.cinema_hall.name || 'Неизвестно';
      acc[hallName] = [...(acc[hallName] || []), session];
    }
    return acc;
  }, {});

  return (
    <section className='movie'>
      <div className='movie__info'>
        <div className="movie__poster">
          <img className="movie__poster-image" alt="Звёздные войны постер" src={film.poster} />
        </div>
        <div className="movie__description">
          <h2 className="movie__title">{film.title}</h2>
          <p className="movie__synopsis">{film.description}</p>
          <p className="movie__data">
            <span className="movie__data-duration">{film.duration} минут</span>
            <span className="movie__data-origin"> {film.origin}</span>
          </p>
        </div>        
      </div>
      
      {Object.keys(groupedSessions).length > 0 && (
        Object.entries(groupedSessions).map(([hallName, sessions]) => (
          <React.Fragment key={hallName}>
            <div className="movie-seances__hall">
            <h3 className="movie-seances__hall-title">{hallName}</h3>
            <ul className="movie-seances__list">
              {sessions.map(session => (
                <li className="movie-seances__time-block" key={session.id}>
                  <a className="movie-seances__time" href="">{moment(session.start_time).format('HH:mm')}</a>
                </li>
              ))}
            </ul>
            </div>
            
          </React.Fragment>
        ))
      )}
      {Object.keys(groupedSessions).length === 0 && <p>На этот день нет показов.</p>}
    </section>
  );
};

FilmCard.propTypes = {
  filmId: PropTypes.number.isRequired,
  selectedDate: PropTypes.instanceOf(moment).isRequired,
};

export default FilmCard;