import React, { PropTypes } from 'react';
import ReactDOM from 'react-dom';
import {Router, Route, browserHistory, Redirect } from 'react-router';
import HomePage from './components/home.jsx';

class App extends React.Component {
   render () {
      return (
         <Router history={browserHistory}>
            <Route path='/' component={HomePage} />
         </Router>
      );
   }
}

export default App;
ReactDOM.render(<App />, document.querySelector('#mountnode'));
