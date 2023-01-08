import React from 'react'
import StyledListItem from './Styled'

const ListItem = ({ item }) => {
    return (
        <StyledListItem>{
            <h3>
                <span className='rank'>{item.rank}. </span>
                <span className='title'>{item.title}</span>
            </h3>}
            <div>
                <span className='comments'>Comments: {item.comments}</span>
                <span className='points'>Points: {item.points}</span>
            </div>
        </StyledListItem>
    )
}

export default ListItem