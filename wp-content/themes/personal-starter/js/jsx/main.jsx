import {Router, Route, browserHistory, Redirect } from 'react-router';
import HomePage from './components/home.jsx';


var React = require('react');
var ReactDOM = require('react-dom');



var App = React.createClass({
   render: function() {
      return (
         <Router history={browserHistory}>
            <Route path='/' component={HomePage} />
         </Router>
      );
   }
});

ReactDOM.render(<App />, document.querySelector('#mountnode'));
