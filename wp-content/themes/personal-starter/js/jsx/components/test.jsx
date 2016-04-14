var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';


var Test = React.createClass({
   getInitialState: function() {
      return {
         dataUrl:''
      };
   },
   componentDidMount: function() {

   },
   goHome: function() {
      browserHistory.push('/');
   },
   render: function() {
      return (
         <div>
            <p>
               This is the second page.
            </p>
            <p>
               Hello.
            </p>
            <a onClick={this.goHome}>Home</a>
         </div>
      );
   }

});

module.exports = Test;
