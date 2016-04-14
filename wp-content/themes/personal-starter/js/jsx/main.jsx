import {Router, Route, browserHistory, Redirect } from 'react-router';
import BlogLoop from './components/blogloop.jsx';
import Test from './components/test.jsx';


var React = require('react');
var ReactDOM = require('react-dom');



var App = React.createClass({
   render: function() {
      return (
         <Router history={browserHistory}>
            <Route path='/' component={BlogLoop} />
            <Route path='/test' component={Test} />   
         </Router>
      );
   }
});

ReactDOM.render(<App />, document.querySelector('#mountnode'));
