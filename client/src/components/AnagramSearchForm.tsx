import { type FC, useState } from "react";
import { Stack } from "@mui/material";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import Box from "@mui/material/Box";
import type { AnagramResponse, AnagramWord } from "@/types";
import axios from "axios";
import AnagramResults from "@/components/AnagramSearchResults.tsx";

interface FormData {
    query: string;
}

const AnagramSearchForm: FC = () => {
    const [formData, setFormData] = useState<FormData>({ query: "" });
    const [error, setError] = useState<string | null>(null);
    const [results, setResults] = useState<string[] | null>(null);
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        setError(null);

        if (formData.query === "" || formData.query.length < 2) {
            setError("Please enter at least two letters.");
            return;
        }

        setLoading(true);

        try {
            const response = await axios.get<AnagramResponse>(
                `http://localhost/api/anagrams/find/${encodeURIComponent(formData.query)}`,
            );

            const anagrams = response.data.data.map(
                (item: AnagramWord) => item.anagram,
            );

            setResults(anagrams);
        } catch (error) {
            setError("Failed to find anagrams.");
        } finally {
            setLoading(false);
        }
    };

    return (
        <>
            <form onSubmit={handleSubmit}>
                <Stack direction="row" spacing={2} alignItems="flex-cender">
                    <TextField
                        id="outlined-basic"
                        label="Letters"
                        variant="outlined"
                        color="info"
                        value={formData.query}
                        onChange={(e) => setFormData({ query: e.target.value })}
                        error={!!error}
                        helperText={error}
                    />
                    <Box>
                        <Button
                            type="submit"
                            variant="contained"
                            size="large"
                            sx={{ height: "55px" }}
                            loading={loading}
                        >
                            Search
                        </Button>
                    </Box>
                </Stack>
            </form>
            <AnagramResults results={results} />
        </>
    );
};

export default AnagramSearchForm;
