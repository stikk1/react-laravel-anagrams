import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { RouterProvider } from "react-router-dom";
import router from "./router.tsx";
import './App.css'
import { ThemeProvider, CssBaseline } from '@mui/material';
import darkTheme from './theme';

createRoot(document.getElementById('root')!).render(
    <StrictMode>
        <ThemeProvider theme={ darkTheme }>
            <CssBaseline />
            <RouterProvider router={ router } />
        </ThemeProvider>
    </StrictMode>,
)
