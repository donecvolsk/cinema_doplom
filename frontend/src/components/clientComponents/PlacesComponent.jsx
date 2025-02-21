import React, { useEffect, useState, useMemo } from 'react';
import PropTypes from 'prop-types';

const PlacesComponent = ({ session }) => {
    const [seats, setSeats] = useState([]); //состояние кресел в зале по типу
    const [sessionSeats, setSessionSeats] = useState([]); //состояние кресел в зале занято
    const [selectedSeat, setSelectedSeat] = useState(null); // Состояние при клике на кресло

    const rowsArray = useMemo(() => {
        return Array.from({ length: session?.cinema_hall?.total_rows || 0 }, (_, i) => i + 1);
    }, [session?.cinema_hall?.total_rows]);

    useEffect(() => {
        const fetchSessionDetails = async () => {
            try {
                // Получение кресел в зале по шаблону для залов
                const response = await fetch(`http://127.0.0.1:8000/api/sessions/hall-seats/${session.id}`);
                const sessionData = await response.json();
                setSeats(sessionData);
                //Получение кресел в зале по типу "занято"
                const seatResponse = await fetch(`http://127.0.0.1:8000/api/session-seats-by-session-id?session_id=${session.id}`);
                const sessionSeatsData = await seatResponse.json();
                setSessionSeats(sessionSeatsData);
            } catch (error) {
                console.error('Error fetching session or film details:', error);
            }
        };
        fetchSessionDetails();
    }, [session.id]);
    // вывод на экран если пропс не получен
    if (!session) {
        return <div>Loading...</div>;
    }
    
    const seatsPerRow = session.cinema_hall.total_seats_per_row;
    //console.log(sessionSeats);
    //функция при клике на кресло
    const handleClick = (rowIndex, colIndex) => {
        if (selectedSeat && selectedSeat[0] === rowIndex && selectedSeat[1] === colIndex) {
            setSelectedSeat(null); // отмена выбора кресла при повторном клике
        } else {
            setSelectedSeat([rowIndex, colIndex]); // Выбираем новое кресло
        }
    };
    return (
        // В компоненте PlacesComponent добавляем передачу rowIndex и colIndex в функцию обратного вызова
        <div className="buying-scheme">
            <div className="buying-scheme__wrapper">
                {rowsArray.map((rowIndex) => (
                    <div key={rowIndex} className="buying-scheme__row">
                        {Array.from({ length: seatsPerRow }, (_, colIndex) => {
                            //const seatNumber = `${rowIndex}-${colIndex + 1}`;       
                            // Определяем типы кресел
                            const isStandard = seats.some(seat => seat.row_number === Number(rowIndex) && seat.seat_number === Number(colIndex + 1) && seat.seat_type_id === 1);
                            const isVIP = seats.some(seat => seat.row_number === Number(rowIndex) && seat.seat_number === Number(colIndex + 1) && seat.seat_type_id === 2);                    
                            const isDisabled = seats.some(seat => seat.row_number === Number(rowIndex) && seat.seat_number === Number(colIndex + 1) && seat.seat_type_id === 3);
                            // Проверяем, забронировано ли место                           
                            const isBooked = sessionSeats.some(seat => seat.row_number === Number(rowIndex) && seat.seat_number === Number(colIndex + 1) && seat.is_booked === 1);   
                            const isSelected = selectedSeat && selectedSeat[0] === rowIndex && selectedSeat[1] === colIndex;
                            // Отключаем возможность клика занятого кресла
                            let disabled = false;
                            if (isBooked) {
                                disabled = true;
                            }
                            //console.log(isBooked);
                            return (
                                <span
                                key={`${rowIndex}-${colIndex}`}
                                onClick={() => !disabled && handleClick(rowIndex, colIndex)} // клике обрабатываются только для активных кресел
                                className={`buying-scheme__chair ${isStandard ? 'buying-scheme__chair_standart' : ''} ${isVIP ? 'buying-scheme__chair_vip' : ''} ${isDisabled ? 'buying-scheme__chair_disabled' : ''} ${isBooked ? 'buying-scheme__chair_taken' : ''} ${isSelected ? 'buying-scheme__chair_selected' : ''}`}
                                disabled={disabled} // атрибут disabled для заблокированных кресел
                                />
                            );
                        })}
                    </div>
                ))}
            </div>
            <div className="buying-scheme__legend">
                <div className="col">
                    <p className="buying-scheme__legend-price"><span className="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span className="buying-scheme__legend-value">250</span>руб)</p>
                    <p className="buying-scheme__legend-price"><span className="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span className="buying-scheme__legend-value">350</span>руб)</p>            
                </div>
                <div className="col">
                    <p className="buying-scheme__legend-price"><span className="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
                    <p className="buying-scheme__legend-price"><span className="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
                </div>
            </div>
        </div>
    );
};

PlacesComponent.propTypes = {
    session: PropTypes.object.isRequired,
};

export default PlacesComponent;
