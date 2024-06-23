/* eslint-disable no-unused-vars */
import { useState ,useEffect} from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Navbar from './navbar';
import NavbarClient from './NavbarClient'; // Import the Navbar component for clients
import Loginclient from './loginclient';
import Loginlawyer from './loginlawyer';
import FirstPage from './SignupClient';
import Signuplawyer from './signuplawyer';
import Mainpage from './mainpage';
import Searchforlawyers from './searchforlawyers';
import LawyerProfile from './lawyerprofile';
import AskingPlace from './Askingplace';
import Feed from './Feed';
import Forum from './Forum';
import Editprofilelawyer from './editprofilelawyer';
import SelfProfileLawyer from './selfprofilelawyer';
import RequestsTab from './request';
import ConfigureRequest from './ConfigureRequest';
import FetchDocuments from './FetchDocuments';
import PostAnn from './PostAnn';
import Announcements from './announcements';
import EditProfile from './EditProfile';
import Reunions from './Reunions';
import EditProfileClient from './EditprofileCli';
import ManageFiles from './Managefiles';
import ForumNotificationModal from './Forumnotificationmodal';
import AcceptedRequests from './RequestResult';

function App() {

  
  // Retrieve user type from session storage
  const [userType, setUserType] = useState(null);

  useEffect(() => {
    // Retrieve user type from session storage
    const userTypeFromSession = sessionStorage.getItem('userType');
    setUserType(userTypeFromSession);
  }, []);

  const isLoggedIn = userType === 'client' || userType === 'lawyer';


  return (
   <h1>hiiiiii</h1> 
  
  );
}

export default App;
