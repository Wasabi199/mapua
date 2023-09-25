<script setup>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="h-20 w-20">
                <JetApplicationLogo/>
            </div>

            <div class="mt-8 text-2xl">
                Welcome to MITRF Admin Dashboard!
            </div>

            <div class="mt-6 text-gray-500 text-justify">
                Mapúa University aims at the empowerment of the youth by providing education grounded on academic
                excellence and strength of character. Students are expected to develop the passion for mental knowledge
                and meritorious performance as well as the recognition of moral values as essential to growth of
                character. the integration of humanities and the social sciences into the technical curriculum has paved
                the way to the achievement of this goal.

                Mapúa upholds the reinforcement of time honored values learned in school and at home directed towards
                the development in the student of a strong moral fiber that will contribute to his/her personal
                well-being as well as that of oher members of society.

                <div class="mt-2">
                    <p class="text-center font-semibold">MAPÚA emphasizes the importance of the following core
                        values:</p>

                    <ol class="list-none text-center">
                        <li class="font-extrabold m-2">
                            DISCIPLINE <br>
                            EXCELLENCE <br>
                            COMMITMENT <br>
                            INTEGRITY <br>
                            RELEVANCE <br>
                        </li>
                    </ol>

                    By ensuring that these core values are learned in the classroom and outside, MAPÚA shall have done
                    its share in producing men and women who live fulfilled and meaningful lives.


                </div>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="ml-4 text-xl text-gray-600 leading-7 font-semibold">
                        VISION
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-md text-gray-500">
                        Mapua shall be among the best universities in the world.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">

                    <div class="ml-4 text-xl text-gray-600 leading-7 font-semibold">
                        MISSION
                    </div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-md text-gray-500">
                        <ol class="list-outside list-item text-justify">
                            <li class="m-4">
                               - The University shall provide a learning environment in order for its students to acquire the
                                attributes that will make them globally competitive.
                            </li>

                                <li class="m-4">
                                   - The University shall engage in publishable and/or economically viable research, development, and
                                    innovation.
                                </li>

                            <li class="m-4">
                               - The University shall provide state-of-the-art solutions to problems of industries and
                                communities.
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
