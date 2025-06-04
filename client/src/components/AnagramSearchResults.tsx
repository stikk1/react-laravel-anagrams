import { type FC } from "react";
import { Box, Typography, List, ListItem, ListItemText } from "@mui/material";

interface AnagramResultsProps {
    results: string[] | null;
}

const AnagramResults: FC<AnagramResultsProps> = ({ results }) => {
    if (results === null) return null;

    return (
        <Box sx={{ textAlign: "center", mt: 2 }}>
            {results.length > 0 ? (
                <>
                    <Typography variant="h4" component="h2">
                        Results
                    </Typography>
                    <List>
                        {results.map((anagram) => (
                            <ListItem key={anagram}>
                                <ListItemText primary={anagram} />
                            </ListItem>
                        ))}
                    </List>
                </>
            ) : (
                <Typography variant="body1" color="text.secondary">
                    No anagrams found.
                </Typography>
            )}
        </Box>
    );
};

export default AnagramResults;
