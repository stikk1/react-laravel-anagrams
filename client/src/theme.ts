// src/theme.ts
import { createTheme } from '@mui/material/styles';

const darkTheme = createTheme({
    palette: {
        mode: 'dark',
        background: {
            default: '#242424',
            paper: '#2e2e2e',
        },
        text: {
            primary: '#ffffff',
        },
    },
});

export default darkTheme;
