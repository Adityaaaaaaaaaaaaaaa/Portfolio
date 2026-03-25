// Firebase Configuration
// TODO: Replace with your actual config object from Firebase Console
const firebaseConfig = {
    apiKey: "AIzaSyD1BpFPC_e5AvwWTt7XpCL-F1oDOkErljk",
    authDomain: "portfolio-cb85f.firebaseapp.com",
    projectId: "portfolio-cb85f",
    storageBucket: "portfolio-cb85f.firebasestorage.app",
    messagingSenderId: "282318876770",
    appId: "1:282318876770:web:168f4cbb895513f7dc613b"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const db = firebase.firestore();
