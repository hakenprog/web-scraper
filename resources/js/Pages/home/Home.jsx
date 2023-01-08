import React, { useEffect, useState } from 'react'

import InputRadio from '../../components/inputRadio/InputRadio'
import ListItem from '../../components/listItem/ListItem'
import SortSelect from '../../components/SortSelect/SortSelect'
import { getData } from '../../services/newsycombinatorService'
import StyledHome from './Styled'


const Home = () => {
  const [staticData, setStaticData] = useState([]);
  const [filterOption, setFilterOption] = useState(3);
  const [ascending, setAscending] = useState(true);

  useEffect(() => {
    getData(setStaticData);
  }, [])

  const getTitleLength = ({ title }) => title.split(' ').length;
  const lengthMoreThanFive = (length) => length > 5;
  const lengthLessThanFive = (length) => length <= 5;
  const sortDescendingOrder = (list, attribute) => list.sort((a, b) => b[attribute] - a[attribute]);
  const sortAscendingOrder = (list, attribute) => list.sort((a, b) => a[attribute] - b[attribute]);
  const filterList = (list, callbackFilter) => list.filter(item => callbackFilter(getTitleLength(item)));
  const getSortOption = () => ascending ? sortAscendingOrder : sortDescendingOrder;


  const handleFilter = (data, callbackSort) => {
    if (filterOption === 3) return staticData;
    if (filterOption === 2) return callbackSort(filterList(data, lengthLessThanFive), 'points')
    return callbackSort(filterList(data, lengthMoreThanFive), 'comments')
  }


  return (
    <StyledHome>
      <h1>Web scraper</h1>
      <p><a target="_blank" href="https://news.ycombinator.com">Visit original site</a></p>
      {filterOption !== 3 &&
        <>
          <SortSelect onChange={() => setAscending(prevState => !prevState)} />
          <p><b>Ordered by {filterOption === 1 ? 'comments' : 'points'}</b></p>
        </>
      }
      <InputRadio name='moreThanFive' checked={filterOption === 1} onChange={() => setFilterOption(1)}>Filter More than Five Words In Title</InputRadio>
      <InputRadio name='lessThanFive' checked={filterOption === 2} onChange={() => setFilterOption(2)}>Filter Less than or equal to Five Words In Title</InputRadio>
      <InputRadio name='all' checked={filterOption === 3} onChange={() => setFilterOption(3)}>Show All</InputRadio>
      <ul>
        {staticData && handleFilter(staticData, getSortOption()).map(item => <ListItem  key={item.rank} item={item} />)}
      </ul>
    </StyledHome>
  )
}

export default Home